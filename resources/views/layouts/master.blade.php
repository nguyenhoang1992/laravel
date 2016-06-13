<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>

    <title>NTQ Solution Admin Control Panel</title>

    <link rel="icon" type="image/ico" href="favicon.ico"/>

    <link href="/css/stylesheets.css" rel="stylesheet" type="text/css"/>

</head>
<body>

<div class="header">
    <a class="logo" href="/">
        <img src="/img/logo.png" alt="NTQ Solution - Admin Control Panel" title="NTQ Solution - Admin Control Panel"/>
    </a>
    
</div>

<div class="menu">

    <div class="breadLine">
        <div class="arrow"></div>
        <div class="adminControl active">
            Hi, {{ Auth::user()->name }}
        </div>
    </div>

    <div class="admin">
        <div class="image">
            <img src="/img/users/avatar.jpg" class="img-polaroid"/>
        </div>
        <ul class="control">
            <li><span class="icon-cog"></span> <a href="#l">Update Profile</a></li>
            <li><span class="icon-share-alt"></span> <a href="/logout">Logout</a></li>
        </ul>
    </div>

    <ul class="navigation">
        <li>
            <a href="/">
                <span class="isw-list"></span><span class="text">Products</span>
            </a>
        </li>
        <li>
            <a href="/category">
                <span class="isw-grid"></span><span class="text">Categories</span>
            </a>
        </li>
        <li>
            <a href="/user">
                <span class="isw-user"></span><span class="text">Users</span>
            </a>
        </li>
    </ul>

</div>

<div class="content">


    <div class="breadLine">
        <ul class="breadcrumb">
            <li><a href="#"></a></li>
        </ul>
    </div>
    
    @if (count($errors) > 0)
        <div class="workplace">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div> 
        </div>
    @endif   
    <div class="workplace">

        @yield('content')

        <div class="dr"><span></span></div>

    </div>

</div>

</body>
</html>