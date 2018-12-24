<?php
namespace APICrud\App\Controllers;

use APICrud\App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $this->outputer->setOutput(200, Article::get()->toArray());
    }
    
    
    public function show($id)
    {
        try {
            $article = Article::findOrFail($id);
            $this->outputer->setOutput(200, $article->toArray());
        } catch (\Exception $ex) {
            $this->outputer->setOutput(404, ['error' => 'this article can not be found.']);
        }
    }
}
