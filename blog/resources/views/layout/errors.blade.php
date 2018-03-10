<div class="errors">
    @if (count($errors) > 0)
        <div class="box-body">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i>错误：</h4>
                @foreach($errors->all() as $error)
                    {{$error}}
                @endforeach
            </div>
        </div>
    @endif
</div>