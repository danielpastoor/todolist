@extends('layouts.app')
@section('customsidebar')
<ul class="nav flex-column">
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center mt-4 mb-1 text-muted">
        <div class="date-picker">
            <input type="hidden" class="selected-date" id="selecteddate" value="" name="">
            <div class="dates active">
                <div class="month">
                    <div class="arrows prev-mth">&lt;</div>
                    <div class="mth"></div>
                    <div class="arrows next-mth">&gt;</div>
                </div>
                <div class="days"></div>
                <button onclick="cleardate()" class="btn-primary clear-btn">Clear</button>
            </div>
        </div>
    </h6>
</ul>
@endsection
@section('content')
<div class="row">
    <div class="col" style="padding: 0px; padding-right: 50px;">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h5 font-weight-bold">Tasks</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button style="margin-right: 30px; color: #3490DC; border: none; background: none" onclick="showactive()">Active</button>
                    <button style="color: #3490DC; border: none; background: none" onclick="showfinished()">Finished</button>
                </div>
            </div>
        </div>
        <div class="justify-content-between align-items-center">
            <form class="searchform" action="">
                <div class="row" style="margin-left: 1em;">
                    <div class="col">
                        <div class="input-group">
                            <input class="form-control py-2" type="tekst" id="myInput" onkeyup="search()" placeholder="search">
                            <input class="form-control py-2" style="display: none" type="tekst" id="finishedInput" onkeyup="finishedsearch()" placeholder="search">
                            <span class="input-group-append">
                                <button style="border-color: #CED4DA; background-color: #FFFFFF" class="btn btn-outline-secondary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createNewTask">
                        <i class="fas fa-plus-circle"></i> New Task
                    </button>
                </div>
            </form>
        </div>
        <br>

        <div id="activetaskes" class="contentlist">
            <ul id="myUL" style="list-style-type: none; margin-left: -1em">
                <?php
                $b_future = 0;
                $b_tomorrow = 0;
                $b_today = 0;
                $b_past = 0;
                ?>
                @if(count($todo) > 0)
                @foreach($todo as $todo)
                <?php
                $valid = 0;
                $id = $todo['id'];
                $name = $todo['name'];
                $category = $todo['category'];
                $content = $todo['content'];
                $enddate = $todo['enddate'];
                $finished = $todo['done'];
                if ($finished == 1) {
                } else {
                    $today = date('Y-m-d');
                    $datetime = new DateTime('tomorrow');
                    $tomorrow =  $datetime->format('Y-m-d');
                    $futuredatetime = new DateTime('+2 day');
                    $future = $futuredatetime->format('Y-m-d');

                    if ($enddate < $today) {
                        $valid = 1;
                        if ($b_past == 0) {
                            echo '<h1 id="showpast" class="h5 font-weight-bold">Past</h1>';
                            $b_past = 1;
                        }
                    } else if ($today == $enddate) {
                        if ($b_today == 0) {
                            echo '<h1 id="showtoday" class="h5 font-weight-bold">Today</h1>';
                            $b_today = 1;
                        }
                    } else if ($tomorrow == $enddate) {
                        if ($b_tomorrow == 0) {
                            echo '<h1 id="showtomorrow" class="h5 font-weight-bold">Tomorrow</h1>';
                            $b_tomorrow = 1;
                        }
                    } else {
                        if ($b_future == 0) {
                            echo '<h1 id="showfuture" class="h5 font-weight-bold">Future</h1>';
                            $b_future = 1;
                        }
                    }
                ?>
                    <li>
                        <input type="hidden" value="<?php echo $name ?>">
                        <input type="hidden" value="<?php echo $category ?>">
                        <input type="hidden" value="<?php echo $enddate ?>">
                        <div class="accordion-card border">
                            <button class="accordion"><?php echo $name ?></button>
                            <div class="panel border-bottom border-top">
                                <div style="padding: 18px">
                                    <p><?php echo $content ?></p>
                                </div>
                            </div>
                            <div <?php if ($valid == 1) {
                                        echo "style='background-color: #DC3545'";
                                    } ?>class="undercard align-items-center">
                                <form action="{{route('updatestatus')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="itemID" value="<?php echo $id ?>">
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="done-button"><i style="color: green;" class="fas fa-check"></i></button>

                                    <span class="card-span"><?php echo $enddate ?></span>
                                    <span class="card-span"><?php echo $category ?></span>

                                    <div class="float-right">
                                        <button type="button" style="color: #3490DC; margin-right: 15px; border: none; background-color: #FFFFFF; text-decoration: none; <?php if ($valid == 1) {
                                                                                                                                                                                echo "background-color: #DC3545";
                                                                                                                                                                            } ?>" data-toggle="modal" data-target="#UpdateTask<?php echo $id ?>">
                                            <i class="far fa-edit fa-lg"></i>
                                        </button>
                                        <a href="{{ route('delete') }}/<?php echo $id ?>" style="color: #3490DC;"><i class="far fa-trash-alt fa-lg"></i></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal fade" id="UpdateTask<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="UpdateTaskTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('update') }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Create new task</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="taskid" value="<?php echo $id ?>">
                                            <div class="form-group row">
                                                <label for="Tekst" class="col-md-4 col-form-label text-md-right">Name</label>

                                                <div class="col-md-6">
                                                    <input id="tekst" type="tekst" class="form-control @error('tekst') is-invalid @enderror" name="taskname" value="<?php echo $name ?>" required autocomplete="email" autofocus>

                                                    @error('tekst')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Tekst" class="col-md-4 col-form-label text-md-right">Content</label>

                                                <div class="col-md-6">
                                                    <textarea class="form-control" name="content" id="" cols="30" rows="8"><?php echo $content ?></textarea>

                                                    @error('tekst')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Tekst" class="col-md-4 col-form-label text-md-right">End-date</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="date" value="<?php echo $enddate ?>" name="enddate" require>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" value="Update Task">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br>
                    </li>
                <?php
                }
                ?>
                @endforeach
                @else
                <h2>There are currently no active tasks</h2>
                @endif
            </ul>
        </div>

        <div id="finishedtasks" style="display: none">
            <ul id="finishedul" style="list-style-type: none; margin-left: -1em">
                @if(count($finshed) > 0)
                @foreach($finshed as $finished)
                <?php

                $id = $finished->id;
                $name = $finished->name;
                $category = $finished->category;
                $content = $finished->content;
                $enddate = $finished->enddate;
                ?>
                <li>
                    <input type="hidden" value="<?php echo $name ?>">
                    <input type="hidden" value="<?php echo $category ?>">
                    <input type="hidden" value="<?php echo $enddate ?>">
                    <div class="accordion-card border">
                        <button class="accordion"><?php echo $name ?></button>
                        <div class="panel border-bottom border-top">
                            <div style="padding: 18px">
                                <p><?php echo $content ?></p>
                            </div>
                        </div>
                        <div class="undercard align-items-center">
                            <form action="{{route('updatestatus')}}" method="POST">
                                @csrf
                                <input type="hidden" name="itemID" value="<?php echo $id ?>">
                                <input type="hidden" name="status" value="0">
                                <button type="submit" class="done-button"><i style="color: red;" class="fas fa-times"></i></button>

                                <span class="card-span"><?php echo $enddate ?></span>
                                <span class="card-span"><?php echo $category ?></span>

                                <div class="float-right">
                                    <a href="{{ route('delete') }}/<?php echo $id ?>" style="color: #3490DC;"><i class="far fa-trash-alt fa-lg"></i></a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                </li>
                @endforeach

                @else
                <h2>There are currently no finished tasks</h2>
                @endif
            </ul>
        </div>

        <script>
            function showactive() {
                document.getElementById('activetaskes').style.display = "inline";
                document.getElementById('finishedtasks').style.display = "none"
                document.getElementById('myInput').style.display = "";
                document.getElementById('finishedInput').style.display = "none"
            }

            function showfinished() {
                document.getElementById('activetaskes').style.display = "none";
                document.getElementById('finishedtasks').style.display = "inline"
                document.getElementById('myInput').style.display = "none";
                document.getElementById('finishedInput').style.display = ""
            }
        </script>
        <div class="modal fade" id="createNewTask" tabindex="-1" role="dialog" aria-labelledby="createNewTaskTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('create') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Create new task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="Tekst" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="tekst" type="tekst" class="form-control @error('tekst') is-invalid @enderror" name="taskname" value="{{ old('tekst') }}" required autocomplete="email" autofocus>

                                    @error('tekst')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Tekst" class="col-md-4 col-form-label text-md-right">Category</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="selector">
                                        <?php var_dump($categorys) ?>
                                        @foreach($categorys as $categorys)
                                        <option><?php echo $categorys['category'] ?></option>
                                        @endforeach
                                    </select>
                                    @error('tekst')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Tekst" class="col-md-4 col-form-label text-md-right">Content</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" name="content" id="" cols="30" rows="8"></textarea>

                                    @error('tekst')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Tekst" class="col-md-4 col-form-label text-md-right">End-date</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" name="enddate" require>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Create Task">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection