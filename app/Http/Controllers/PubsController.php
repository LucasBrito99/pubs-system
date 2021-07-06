<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pub;

class PubsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pubs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // $pub = new Pub;
       // $pub->user_id = 1;
       // $pub->pub = $request->input('pub');
       // $pub->save();

        $pub = Pub::create([
            'user_id' => auth()->user()->id,
            'pos' => Pub::all()->count(),
            'pub' => $request->input('pub')
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pub = Pub::find($id);

        if($request->input('up') !== null && $pub->pos > 0){
            $next_pub = Pub::where('pos', $pub->pos - 1)->get()->first();
            //Desloca para cima a publicação
            $pub->update([
                'pos' => $pub->pos - 1
            ]);
            //Encontra a publicação que está acima da que eu quero mover
            if(isset($next_pub)){
                //Move a publicação acima, para baixo da que quero mover
                $next_pub->update([
                    'pos' => $next_pub->pos + 1
                ]);
            }
            
        }
        else if($request->input('down') !== null && ($pub->pos + 1 < count(Pub::all()))){
            $next_pub = Pub::where('pos', $pub->pos + 1)->get()->first();
            $pub->update([
                'pos' => $pub->pos + 1
            ]);
            if(isset($next_pub)){
                //Move a publicação acima, para baixo da que quero mover
                $next_pub->update([
                    'pos' => $next_pub->pos - 1
                ]);
            }
        }
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pub $pub)
    {

        $pubs = Pub::where('pos', '>', $pub->pos)->get();

        foreach($pubs as $item){
            $item->update([
                'pos' => $item->pos - 1
            ]);
        };

        $pub->delete();

        return redirect('/');
    }
}
