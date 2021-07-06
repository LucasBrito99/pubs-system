@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
                    role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">



                <div class="container-fluid gedf-wrapper" style="margin-top: 10px; margin-bottom: 10px">
                    <div class="row">
                        <div class="col-md-9 gedf-main">

                            <div class="card gedf-card">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts"
                                                role="tab" aria-controls="posts" aria-selected="true">Make
                                                a publication</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <form action="/pubs" method="POST">
                                            @csrf
                                            <div class="tab-pane fade show active" id="posts" role="tabpanel"
                                                aria-labelledby="posts-tab">
                                                <div class="form-group">
                                                    <label class="sr-only" for="message">post</label>
                                                    <textarea class="form-control" id="message" rows="3" name="pub"
                                                        placeholder="What are you thinking?"></textarea>
                                                </div>
                                            </div>
                                            <!--<div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                                                <div class="form-group">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="customFile">
                                                                        <label class="custom-file-label" for="customFile">Upload image</label>
                                                                    </div>
                                                                </div>
                                                                <div class="py-4"></div>
                                                            </div>-->
                                    </div>
                                    <div class="btn-toolbar justify-content-between">
                                        <div class="btn-group">
                                            <button class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>

                            @foreach ($pubs as $pub)
                                <div class="card gedf-card" style="margin-bottom: 10px; margin-top: 10px">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="ml-2">
                                                    <div class="h5 m-0">{{ '@' . $pub->user->username }}</div>
                                                    <div class="h7 text-muted">{{ $pub->user->name }}</div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="dropdown">
                                                    <button class="btn btn-link dropdown-toggle" type="button"
                                                        id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="gedf-drop1">
                                                        <div class="h6 dropdown-header">Configuration</div>
                                                        <form id="up_pub_{{ $pub->id  }}" action="/pubs/{{ $pub->id }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="text" name="up" value="1" hidden>
                                                            <a class="dropdown-item" href="#"
                                                                onclick="document.getElementById('up_pub_{{ $pub->id  }}').submit()"><i
                                                                    class="fas fa-arrow-up"></i>
                                                                Up</a>
                                                        </form>
                                                        <form id="down_pub_{{ $pub->id  }}" action="/pubs/{{ $pub->id }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="text" name="down" value="-1" hidden>
                                                            <a class="dropdown-item" href="#"
                                                                onclick="document.getElementById('down_pub_{{ $pub->id  }}').submit()"><i
                                                                    class="fas fa-arrow-down"></i> Down</a>
                                                        </form>
                                                        <form id="delete_pub_{{ $pub->id  }}" action="/pubs/{{ $pub->id }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <a class="dropdown-item" href="#"
                                                                onclick="document.getElementById('delete_pub_{{ $pub->id  }}').submit()"><i
                                                                    class="fas fa-trash"></i> Delete
                                                                Publication</a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>
                                            {{ $pub->created_at }}</div>
                                        <p class="card-text">
                                            {{ $pub->pub }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="h5">{{ '@' . Auth::user()->username }}</div>
                                    <div class="h7 text-muted">Fullname : {{ Auth::user()->name }}</div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="h6 text-muted">Publications</div>
                                        <div class="h5">{{ $num_pubs }}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </section>
        </div>
    </main>
@endsection
