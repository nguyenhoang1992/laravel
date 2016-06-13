@extends('layouts.master')

@section('content')
<div class="row-fluid">

    <div class="span12">
        <div class="head">
            <div class="isw-grid"></div>
            <h1>Categories Management</h1>

            <div class="clear"></div>
        </div>
        <div class="block-fluid">
            <form action="" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}"> 
            	<div class="row-form">
                    <div class="span3">Category Name:</div>
                    <div class="span9"><input type="text" name="name" value="<?php echo $item->name; ?>"/></div>
                    <div class="clear"></div>
                </div> 
                <div class="row-form">
                    <div class="span3">Activate:</div>
                    <div class="span9">
                        <select name="active">
                            <?php 
                                if($item->active == 1){
                                    echo '<option value="1" selected>Activate</option>';
                                    echo '<option value="0">Deactivate</option>';
                                } else {
                                    echo '<option value="1">Activate</option>';
                                    echo '<option value="0" selected>Deactivate</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>                          
                <div class="row-form">
                	<button class="btn btn-success" type="submit">Edit</button>
					<div class="clear"></div>
                </div>
            </form>
            <div class="clear"></div>
        </div>
    </div>

</div>

@stop