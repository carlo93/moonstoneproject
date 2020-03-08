<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Tree Items
        $treeItems = Tree::with('childs')->get();

        return view('tree.index', [
            "treeItems" => $treeItems,
        ]);
    }

    /**
     * Filter through Tree Set.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter($request)
    {
        if (\Illuminate\Support\Facades\Request::ajax())
        {
            $treeItems = null;
            // Check if Filter Request is set
            if($request !== 'Empty')
            {
                // Get Tree Results
                $result = Tree::whereRaw('name like ?', ["%{$request}%"])->get();
                // Set New Collection
                $treeItems = new Collection();

                // loop Results and check to unlink child sets not containing the string
                foreach ($result as $item)
                {
                    $treeItems->push($item);

                    if($item->pef_item_id)
                    {
                        $parent = Tree::where('id', $item->pef_item_id)->get()->first();

                        foreach ($parent->childs as $i => $child)
                        {
                            if($child && strpos(strtolower($child->name), strtolower($request)) !== false)
                            {
                                continue;
                            }

                            unset($parent->childs[$i]);
                        }

                        $treeItems->push($parent);

                    }
                }
            }
            else{
                // Get All results
                $treeItems = Tree::with('childs')->get();
            }

            $template = view('tree.filter')->with(compact('treeItems'));

            return $template;
        }



    }

}
