<div class="card card-default">
    <div class="card-body">
        <form action="{{ $action }}" method="{{ $method ?? 'GET' }}">
        <div class="row">
            <div class="col-8">
                @csrf
                <input type="hidden" name="basic_search" value="true">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Cari berdasarkan {{ isset($placeholder) ? Str::title($placeholder) : Str::title($key) }}" name="{{ $key }}" value="{{ Request::get($key) }}">
                    </div>
            </div>
            <div class="col-2">
                @if(Request::has('basic_search'))
                    <a href="{{ $action }}" class="btn btn-default btn-block">Reset</a>
                @endif
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-success btn-block">Cari</button>
            </div>
            <div class="col-12">
                @isset($partials)
                    @include($partials)
                @endisset
            </div>
        </div>
        </form>
    </div>
</div>
