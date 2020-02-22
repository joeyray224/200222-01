<?php 
    namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use DB;
    use Illuminate\Pagination\Paginator;

    class BorderController extends Controller {
        public function show() {
            return view('main');
        }

        public function createBoard () {
            return view('createBoard');
        }

        public function addResult (Request $request) {
            $title = $request -> input('title');
            $description = $request -> input('description');
            $price = $request -> input('price');
            $contact = $request -> input('contact');

            return DB::table('boards') ->insertGetId([
                'title' => $title,
                'description' => $description,
                'price' => $price,
                'contact' => $contact
            ]);
        }

        public function showSinglePage ($id, $fields = false) {
                $arr = [];
                $elem = DB::table('boards')->where('id', $id) -> first();
                    
                $arr = ['title' => $elem->title, 'price' => $elem->price];
                
            if ($fields) {
                $arr['description'] = $elem->description;
                $arr['contact'] = $elem->contact;
            }
                
            return json_encode($arr, JSON_UNESCAPED_UNICODE);
        }

        public function showAllBoards ($sort = false) {
            $name = 'id';
            $direction = 'asc';
            if ($sort) {
                switch ($sort) {
                    case 1:
                        $name = 'price';
                        $direction = 'asc';
                        break;
                    case 2:
                        $name = 'price';
                        $direction = 'desc';
                        break;
                    case 3:
                        $name = 'date';
                        $direction = 'asc';
                        break;
                    case 4:
                        $name = 'date';
                        $direction = 'desc';
                        break;
                }
            }
            
            $perPage = 10;
            $paginate = DB::table('boards')->paginate($perPage);
            $boards = DB::table('boards')->orderBy($name, $direction)->select('title', 'price')->get();
            

            $arr = [];

            foreach ($boards as $elem) {
                array_push($arr, json_encode($elem, JSON_UNESCAPED_UNICODE));
            }

            $show = array_slice($arr, ($paginate -> currentPage() - 1) * $perPage, $perPage);
            
            return view('showAllBoards', ['paginator' => $paginate, 'show' => $show]);
        }
    }