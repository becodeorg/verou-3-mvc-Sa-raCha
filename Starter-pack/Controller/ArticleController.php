<?php

declare(strict_types = 1);

class ArticleController
{
    // TODO: prepare the database connection
    private DatabaseManager $databaseManager;

    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    public function index()
    {
        // Load all required data
        $articles = $this->getArticles();

        // Load the view
        require 'View/articles/index.php';
    }

    // Note: this function can also be used in a repository - the choice is yours
    private function getArticles()
    {
        $sql = "SELECT * FROM articles";
        $statement = $this->databaseManager->connection->prepare($sql);
        $statement->execute();
        //TODO: fetch all articles as $rawArticles (as a simple array)
        $result =  $statement->fetchAll(PDO::FETCH_ASSOC);
        $rawArticles = $result;

        $articles = [];
        foreach ($rawArticles as $rawArticle) {
            // We are converting an article from a "dumb" array to a much more flexible class
            $articles[] = new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'], $rawArticle['publish date']);
        }

        return $articles;
    }

    public function show()
    {
        // TODO: this can be used for a detail page
        $sql = "SELECT * FROM articles WHERE id ={$_GET['id']}";
        $statement = $this->databaseManager->connection->prepare($sql);
        $statement->execute();
        $result =  $statement->fetch();
        $article = new Article($result['id'], $result['title'], $result['description'], $result['publish date']);
        
        require 'View/articles/show.php';
    }
}