@extends('layouts.app')
<?php 
$products=App\Models\Product::all();
?>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Créer un produit</button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Créer un produit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                   <form action="{{route('add')}}" method="post" enctype="multipart/form-data">
                                     {{csrf_field()}}
                                        <input type="hidden" name="id" >
                                        <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Nom:</label>
                                        <input name="nom" type="text"  class="form-control" id="recipient-name">
                                    </div>
                                     <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Prix:</label>
                                        <input required name="prix" type="text"class="form-control" id="recipient-name">
                                    </div>
                                     <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Stock:</label>
                                        <input required name="stock" type="text" class="form-control" id="recipient-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">catégorie:</label>
                                        <input required name="categories"type="text"  class="form-control" id="recipient-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Déscription:</label>
                                        <input required name="description"type="text"  class="form-control" id="recipient-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Image:</label>
                                        <input required type="file" name="filenames[]" multiple class="myfrm form-control">
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                              
                                    
                                    </form>
                                </div>
                                
                                </div>
                            </div>
                            </div>
                     

                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col">Stock</th>
                          <th scope="col">Opération</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                       
                        <tr>
                        <th scope="row">{{$product->nom}}</th>
                        <td>{{$product->prix}}</td>
                        <td>{{$product->categorie}}</td>
                          <td>{{$product->stock}}</td>
                        <td>
                            <a class="btn btn-danger"href="{{route('delete',['id'=>$product->id])}}">Supprimer</a>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$product->id}}" data-whatever="@getbootstrap">Voir/modifier</button>

                            <div class="modal fade" id="exampleModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$product->nom}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="demo" class="carousel slide" data-ride="carousel">

                                        <!-- Indicators -->
                                        <ul class="carousel-indicators">
                                            <li data-target="#demo" data-slide-to="0" class="active"></li>
                                            <li data-target="#demo" data-slide-to="1"></li>
                                            <li data-target="#demo" data-slide-to="2"></li>
                                        </ul>
                                        
                                        <!-- The slideshow -->
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                            <img src="{{$product->images->first()->path}}" alt="Los Angeles" width="500">
                                            </div>
                                            @foreach($product->images as $img)
                                            <div class="carousel-item">
                                            <img src="{{$img->path}}" alt="Los Angeles" width="500" >
                                            </div>
                                            @endforeach
                                        
                                        </div>
                                        
                                        <!-- Left and right controls -->
                                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                            <span class="carousel-control-prev-icon"></span>
                                        </a>
                                        <a class="carousel-control-next" href="#demo" data-slide="next">
                                            <span class="carousel-control-next-icon"></span>
                                        </a>
                                        </div>
                                   
                                  
                                  
                                    <form action="{{route('update')}}" method="post" enctype="multipart/form-data">
                                     {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{$product->id}}">
                                        <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Nom:</label>
                                        <input name="nom" type="text" value="{{$product->nom}}" class="form-control" id="recipient-name">
                                    </div>
                                     <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Prix:</label>
                                        <input required name="prix" type="text" value="{{$product->prix}}" class="form-control" id="recipient-name">
                                    </div>
                                     <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Stock:</label>
                                        <input required name="stock" type="text" value="{{$product->stock}}" class="form-control" id="recipient-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">catégorie:</label>
                                        <input required name="categories"type="text" value="{{$product->categorie}}" class="form-control" id="recipient-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Déscription:</label>
                                        <input required name="description"type="text" value="{{$product->description}}" class="form-control" id="recipient-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Image:</label>
                                        
                                        <input type="file" id="files" name="filenames[]" multiple>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                              
                                    
                                    </form>
                                </div>
                                
                                </div>
                            </div>
                            </div>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
