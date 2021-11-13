<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\WorkersRequest;
use App\workers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiWorkers extends Controller
{
    public function index(){
        return Workers::all();
    }

    public function edit($id){
        return Workers::find($id);
    }

    public function save(WorkersRequest $data, $id){
        if($id != 'undefined'){
            $worker = Workers::find($id);

        }else{
            $worker = new Workers();
        }

        $worker->name = $data->input('name');
        $worker->birth = $data->input('birth');
        $worker->prof = $data->input('prof');
        $worker->save();
    }

    public function delete($id){
        Workers::find($id)->delete();
    }
}
