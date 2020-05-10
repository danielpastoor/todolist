@extends('layouts.app')

@section('auth')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Settings</div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCategory">
                        <i class="fas fa-plus-circle"></i> New Category
                    </button>
                    <div style="height: 10px"></div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $count = 1;
                            ?>
                            @foreach($categorys as $category)
                            <?php
                                $id = $category['id'];
                                $name = $category['category'];
                            ?>
                            <tr>
                                <th scope="row"><?php echo $count; $count++;?></th>
                                <td><?php echo $name?></td>
                                <td><a href="{{ route('deletecategory') }}/<?php echo $id?>" style="color: #3490DC;"><i class="far fa-trash-alt fa-lg"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="createNewTaskTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action="{{route('createcategory')}}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Create new Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="Tekst" class="col-md-4 col-form-label text-md-right">Name</label>

                                        <div class="col-md-6">
                                            <input id="tekst" type="tekst" class="form-control @error('tekst') is-invalid @enderror" name="categoryname" value="{{ old('tekst') }}" required autocomplete="email" autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Create Category">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection