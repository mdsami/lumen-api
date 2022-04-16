<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citizen;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;

class CitizenController extends Controller
{
    
        use ApiResponser;
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct(Citizen $citizen)
        {
            $this->citizen = $citizen;

        }
    
        /**
        * Return full list of authors
        * @return Response
        */
        public function index()
        {
        
            $authors = Citizen::all();
            return $this->successResponse($authors);
        }
    
    
        /**
         * Create one new authors
         * @param Request $request
         * @return Response
         */
        public function store(Request $request)
        {
            $rules = [
                'name'      => 'required|max:254',
                'gender'    => 'required|max:20|in:male,female',
                'country'   => 'required|max:254',
            ];
    
            $this->validate($request, $rules);
    
            $author = Citizen::create($request->all());
    
            return $this->successResponse($author, Response::HTTP_CREATED);
        }
    
    
        /**
         * Show a specific author
         * @param Author $author
         * @return Response
         */
        public function show($author)
        {
            $author = Citizen::findOrFail($author);
            return $this->successResponse($author);
        }
    
    
        /**
         * Update author information
         * @param Request $request
         * @param $author
         * @return \Illuminate\Http\JsonResponse
         */
        public function update(Request $request, $author)
        {
            $rules = [
                'name'      => 'max:254',
                'gender'    => 'max:20|in:male,female',
                'country'   => 'max:254',
            ];
            $this->validate($request, $rules);
            $author = Citizen::findOrFail($author);
            $author->fill($request->all());
            if($author->isClean()){
                return $this->errorResponse("Atleast one value must change", Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $author->save();
            return $this->successResponse($author);
        }
    
    
        /**
         * Delete author information
         * @param $author
         * @return \Illuminate\Http\JsonResponse
         */
        public function destroy($author)
        {
            $author = Citizen::findOrFail($author);
            $author->delete();
            return $this->successResponse($author);
        }
    }