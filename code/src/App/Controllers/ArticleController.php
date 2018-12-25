<?php
namespace APICrud\App\Controllers;

use APICrud\App\Models\Article;
use APICrud\App\Helpers\JWTHelpers;
use APICrud\App\Helpers\Auth;

class ArticleController extends Controller
{

    use JWTHelpers;
    use Auth;

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

    public function create()
    {
        $token = $this->checkAuth();

        if (isset($_POST['title'], $_POST['body'])) {
            $article = new Article;
            $article->title = $_POST['title'];
            $article->body = $_POST['body'];
            $article->user_id = $token['id'];

            if ($article->save()) {
                $this->outputer->setOutput(200, ['success' => 'article saved.']);
            }
            $this->outputer->setOutput(430, ['error' => 'Error happend while saving you article.']);
        }

        $this->outputer->setOutput(403, ['error' => 'Missing Parameters: you must specify title, body']);
    }

    public function update($id)
    {
        $token = $this->checkAuth();

        try {
            parse_str(http_build_query(file_get_contents("php://input")),$data);
            print_r($data);die;
            if (isset($_POST['title'], $_POST['body'])) {
                $article = Article::where('id', $id)->where('user_id', $token['id'])->first();
                if (!$article) {
                    throw new \Exception("article not found", 1);
                    
                }

                $article->title = $_POST['title'];
                $article->body = $_POST['body'];

                if ($article->save()) {
                    $this->outputer->setOutput(200, ['success' => 'article saved.']);
                }
                $this->outputer->setOutput(430, ['error' => 'Error happend while saving you article.']);
            }

            $this->outputer->setOutput(403, ['error' => 'Missing Parameters: you must specify title, body']);
        } catch (\Exception $e) {
            $this->outputer->setOutput(404, ['error' => 'we could not find your article']);
        }
    }

    public function delete()
    {
        
    }
}
