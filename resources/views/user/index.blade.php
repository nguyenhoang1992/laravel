@extends('layouts.master')

@section('content')

<div class="row-fluid">
    <div class="span12 search">
        <form>
            <input type="text" class="span11" placeholder="Some text for search..." name="search"/>
            <button class="btn span1" type="submit">Search</button>
        </form>
    </div>
</div>
<!-- /row-fluid-->

<div class="row-fluid">

    <div class="span12">
        <div class="head">
            <div class="isw-grid"></div>
            <h1>Users Management</h1>

            <div class="clear"></div>
        </div>
        <div class="block-fluid table-sorting">
        <form action="">
         <input type="hidden" name="_token" value="{!! csrf_token() !!}"> 
            <a href="/user/add" class="btn btn-add">Add User</a>
            <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"/></th>
                    <th width="15%" class="sorting"><a href="#">ID</a></th>
                    <th width="35%" class="sorting"><a href="#">Username</a></th>
                    <th width="20%" class="sorting"><a href="#">Activate</a></th>
                    <th width="10%" class="sorting"><a href="#">Time Created</a></th>
                    <th width="10%" class="sorting"><a href="#">Time Updated</a></th>
                    <th width="10%">Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($lists as $list): ?>
                        <tr>
                            <td><input type="checkbox" name="checkbox[]" value="<?php echo $list->id; ?>" /></td>
                            <td><?php echo $list->id; ?></td>
                            <td><?php echo $list->name; ?></td>
                            <td><span class="text-success"><?php echo $list->active; ?></span></td>
                            <td><?php echo $list->created_at; ?></td>
                            <td><?php echo $list->updated_at; ?></td>
                            <td><a href="/user/edit/<?php echo $list->id; ?>" class="btn btn-info">Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="bulk-action">
                <button type="submit" name="active" value="1" class="btn btn-success">Activate</button>
                <button type="submit" name="delete" value="1" class="btn btn-danger">Delete</button>
            </div><!-- /bulk-action-->
            <div class="dataTables_paginate">
                <a class="first paginate_button " href="/user?page=1">First</a>
                <?php echo $lists->render(); ?>
                <a class="last paginate_button" href="/user?page=<?php echo $lists->lastPage(); ?>">Last</a>
            </div>
            <div class="clear"></div>
        </form>
        </div>
    </div>

</div>
@stop