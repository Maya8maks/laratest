<div class="dashboard__main">
    {!! Form::open(
        [
            'url'=>route('account',array('id'=>$doctor->id)),
            'method'=>'POST',
            'class'=>'dashboard_table account',
            'enctype'=>'multipart/form-data',
        ])
    !!}
        <h5 class="table_title">My info</h5>
            <label>Username</label>
            <input type="text" readonly name="userName" value="{{$doctor->user_name}}">
            @if ($errors->has('userName'))
                <p class="errorMessage">
                    <strong>{{ $errors->first('userName')}}</strong>
                </p>
            @endif
            <label>Profession</label>
            <input type="text" readonly name="profession"  value="{{$doctor->profession}}">
            @if ($errors->has('profession'))
                <p class="errorMessage">
                    <strong>{{ $errors->first('profession')}}</strong>
                </p>
            @endif
            <label>First Name</label>
            <input type="text" readonly name="name" value="{{$doctor->name}}">
            @if ($errors->has('name'))
                <p class="errorMessage">
                    <strong>{{ $errors->first('name')}}</strong>
                </p>
            @endif
            <label>Last Name</label>
            <input type="text" readonly name="lastName" value="{{$doctor->lastname}}">
            @if ($errors->has('lastName'))
                <p class="errorMessage">
                    <strong>{{ $errors->first('lastName')}}</strong>
                </p>
            @endif
            <label>Country</label>
            <input type="text"  readonly name="country" value="{{$doctor->country}}">
            @if ($errors->has('country'))
                <p class="errorMessage">
                    <strong>{{ $errors->first('country')}}</strong>
                </p>
            @endif
            <label>Authorization ID</label>
            <input disabled  name="id" value="{{$doctor->id}}">
            <button class="sbmt" type="submit" name="submit">Submit</button>
    {!! Form::close() !!}
</div>