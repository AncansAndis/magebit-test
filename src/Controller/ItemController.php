<?php
namespace Controller;

use Factory\Repository\MysqlRepositoryFactory;
use Framework\Template;
use Controller\SubscribeController;
use Repository\Emails\EmailsMysqlRepository;

class ItemController
{
    /**
     * @var Template
     */
    protected $template;

    /**
     * @var \Controller\SubscribeController
     */
    protected $subscribeController;

    protected $adminController;

    public function __construct()
    {
        $this->template = new Template();
        $this->subscribeController = new SubscribeController();
        $this->adminController = new AdminController();
    }

    public function index()
    {
        $this->template->renderOnlyFile('frontend/index.php');
    }

    public function subscribe()
    {
        $this->subscribeController->execute();
    }

    public function subscribed()
    {
        $this->template->renderOnlyFile('frontend/subscribed.php');
    }

    public function admin()
    {
        $this->adminController->execute();
    }

}
