<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PersonController extends Controller
{
    public function create(){
        return view('person.create');
    }

    public function store(Request $req){
       $name = $req->name;
       $email = $req->email;
       $birth_date = $req->birth_date;
       $salary = $req->salary;

       // Next, we have to insert the values in the database table
       DB::table('persons')->insert([
            'name' => $name,
            'email' => $email,
            'birth_date' => $birth_date,
            'salary' => $salary
        ]);
        return redirect('persons');
    }

    public function all(){
        $data = DB::table('persons')->get(); // SELECT * FROM persons // returns an array
        return view('person.all', ['persons'=>$data]);
    }

    public function edit($id){
        $result = DB::table('persons')
            ->where('id', '=', $id)
            ->first(); // SELECT * from persons WHERE id = 2
        return view('person.edit', ['person'=>$result]); 
    }
    public function update(Request $r, $id){
        $name = $r->name;
        $email = $r->email;
        $birth_date = $r->birth_date;
        $salary = $r->salary;

        $affected = DB::table('persons')
              ->where('id', $id)
              ->update(['name' => $name,
                    'email' => $email,
                    'birth_date' => $birth_date,
                    'salary' => $salary]);
        return redirect('persons');
    }

    public function delete($id){
        $deleted = DB::table('persons')
                        ->where('id', '=', $id)
                        ->delete(); 
        return redirect('persons');
    }
}
