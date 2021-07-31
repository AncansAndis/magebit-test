<?php

namespace Controller;

use Factory\Repository\MysqlRepositoryFactory;
use Framework\Template;
use JetBrains\PhpStorm\NoReturn;
use Repository\Emails\EmailsMysqlRepository;

class AdminController
{

    /**
     * @var Template
     */
    private $template;

    /**
     * @var EmailsMysqlRepository
     */
    private $emailsRepository;

    public function __construct()
    {
        $this->template = new Template();
        $this->emailsRepository = (new MysqlRepositoryFactory)->create(EmailsMysqlRepository::class);
    }

    public function execute()
    {
        $emails = null;
        $emailProviders = $this->prepareProviders();

        if (isset($_POST['reset'])) {
            unset($_POST);
        }

        if (isset($_POST['orderBy']) && $_POST['orderBy'] === "email") {
            $emails = $this->emailsRepository->fetchAllByAttr('email');
        }

        if (isset($_POST['orderBy']) && $_POST['orderBy'] === "date_created") {
            $emails = $this->emailsRepository->fetchAllByAttr('date_created');
        }

        if (isset($_POST['filter'])) {
            $emails = $this->emailsRepository->fetchAllByString($_POST['filter']);
        }

        if (isset($_POST['remove']))
        {
            $this->emailsRepository->removeById($_POST['remove']);
            unset($_POST['remove']);
        }

        if (isset($_POST['exportCSV']))
        {
            $allChecked = $_POST['exportCSV'];
            $stringToExport = '';

            for($x = 0 ; $x<count($allChecked); $x++){
                if($x!=(count($allChecked)-1)){
                    $stringToExport = $stringToExport . $allChecked[$x] . ', ';
                }else {
                    $stringToExport = $stringToExport . $allChecked[$x];
                }
            }

            $emailsToCSV = $this->emailsRepository->selectMultiple($stringToExport);

            $this->emailToCsvDownload($emailsToCSV);
        }

        if (is_null($emails)) {
            $this->template->assign(['emails' => $this->emailsRepository->fetchAll(), 'providers' => $emailProviders])->render('adminhtml/admin.php');
        } else {
            $this->template->assign(['emails' => $emails, 'providers' => $emailProviders])->render('adminhtml/admin.php');
        }
    }

    /**
     * Prepare email provider strings
     *
     * @return array
     */
    public function prepareProviders(): array
    {
        $email_providers = [];
        foreach ($this->emailsRepository->fetchAll() as $email) {
            array_push( $email_providers, substr(strrchr($email->getEmail(), "@"), 0) );
        }
        return $email_providers;
    }

    /**
     * Creates and pushes CSV file
     *
     * @param $array
     * @param string $filename
     * @param string $delimiter
     */
    #[NoReturn] function emailToCsvDownload($array, $filename = "export.csv", $delimiter=";") {
        ob_get_clean();
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        $f = fopen('php://output', 'x');
        foreach ($array as $line) {
            $content = [$line->getId(), $line->getEmail(), $line->getDateCreated()];
            fputcsv($f, $content, $delimiter);
        }
        fpassthru($f);
        exit();
    }

}