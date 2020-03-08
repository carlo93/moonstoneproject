<!DOCTYPE html>
<html>
<head>
    <title>Laravel Category Treeview Example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tree.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">Manage TreeView</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <h3>List</h3>
                    <div class="form-group">
                        {!! Form::label('filter', 'Filter: <span class="text-danger">*</span>', [], false) !!}
                        {!! Form::text('filter', null, ['class' => 'form-control', 'required', 'id' => 'filter']) !!}
                    </div>
                    <div class="tree-list">
                        <ul id="tree1">
                            @foreach($treeItems as $item)
                                <li>
                                    {{ $item->name }}
                                    @if(count($item->childs))
                                        @include('tree/manageChild',['childs' => $item->childs])
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/tree.js"></script>

</body>
</html>
