
@extends('admin.include.master_file')
@section('title')
Faqs
@endsection
@section('body')


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    @if (null !== session('status'))
                    <div id="alertBox" class="alert alert-success" role="alert">
                        {{session('status')}}
                      </div>
                    @endif
                    @if (null !== session('deleted'))
                    <div id="alertBox" class="alert alert-danger" role="alert">
                        {{session('deleted')}}
                      </div>
                    @endif
                   
                    <div class="position-relative mb-3 text-start ">
                        <h3 class="mb-4 d-inline">Manage FAQs</h3>        
                <a  href="{{route('Faqs.create')}}" class="nav-item nav-link d-inline btn btn-dark position-absolute top-0 end-0" >Add FAQ</a>
                    </div>
                    <div class="table-responsive">
                        <table  class="table text-center align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                    <th scope="col">Question</th>
                                    <th scope="col">Answer</th>
                                    <th scope="col">Status</th> 
                                    <th scope="col">Action</th>                        
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($faqs as $faq )
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>{{$faq->question}}</td>
                                    <td>{!!$faq->answer!!}</td>
                                    <td><div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="{{route('Faqs.show',['id'=>$faq->id])}}" class="btn btn-warning">Update</a>
                                        <a href="{{route('Faqs.destroy',['id'=>$faq->id])}}" class="btn btn-danger">Delete</a>
                                      </div></td>
                                      <td>
                                        @if($faq->status == 'block')
                                        <a href="{{route('Faqs.edit',['id'=>$faq->id])}}" class="btn btn-success">Show</a>
                                        @else
                                        <a href="{{route('Faqs.edit',['id'=>$faq->id])}}" class="btn btn-danger">Hide</a>
                                        @endif
                                    </td>
                                </tr> 
                                @endforeach
                              
                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
     
@endsection