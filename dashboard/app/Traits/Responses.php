<?php
namespace App\Traits;

trait Responses {

    public function data(array $data , string $msg ='' ){

        return response()->json([
            'message'=> $msg,
            'data' => (object)$data,
            'error' => (object)[]

        ]);
    }

    public function error(array $error , string $msg ='' ){

        return response()->json([
            'message'=> $msg,
            'data' => (object)[],
            'error' => (object)$error,

        ]);
    }

    public function success( string $msg  ){

        return response()->json([
            'message'=> $msg,
            'data' => (object)[],
            'error' => (object)[]

        ]);
    }
}

?>