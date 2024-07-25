<div class="row">

    <div class="col">
        {{ Form::open(['url' => 'url', 'id' => 'form_rat']) }}
        {{ Form::token() }}

        <div class="row">
            <div class="p-3 col-md-12">
                {{ Form::label('', '') }}:
                {{ Form::text('', '', ['class' => 'form form-control', 'id' => '', 'placeholder' => '', 'maxlength' => '']) }}
            </div>
        </div>
            
            {{ Form::submit('Salvar', ['class' => 'btn btn-primary', 'id' => 'btn']) }}
        {{ Form::close() }}
    </div>

</div>