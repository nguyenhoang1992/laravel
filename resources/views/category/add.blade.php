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
                    <div class="span9"><input type="text" name="name" placeholder="some text value..."/></div>
                    <div class="clear"></div>
                </div> 
                <div class="row-form">
                    <div class="span3">Activate:</div>
                    <div class="span9">
                        <select name="active">
                            <option value="1">Activate</option>
                            <option value="0">Deactivate</option>
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>                          
                <div class="row-form">
                	<button class="btn btn-success" type="submit">Create</button>
					<div class="clear"></div>
                </div>
            </form>
            <div class="clear"></div>
        </div>
    </div>

</div>

@stop