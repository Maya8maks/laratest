<div class="dashboard__main">
    <div class="dashboard_table account">
        {!! Form::open(
            [
                'url'=>route('register'),
                'class'=>'physician__form',
                'method'=>'POST',
                'enctype'=>'multipart/form-data',
                'style'=>'position: relative'
            ])
         !!}
        <label>User name</label>
        <input type="text" name="user_name" placeholder="User name">
        @if ($errors->has('user_name'))
            <p class="errorMessage">
                <strong>{{ $errors->first('user_name') }}</strong>
            </p>
        @endif
        <label>Password</label>
        <input type="text" name="password" placeholder="password" id="password" >
        @if ($errors->has('password'))
            <p class="errorMessage">
                <strong>{{ $errors->first('password') }}</strong>
            </p>
        @endif
        <label>Confirm Password</label>
        <input type="text" name="password_confirmation" placeholder="Confirm Password" id="password-confirm">
        <label>Profession</label>
        <input type="text" name="profession" placeholder="General practitioner">
        @if ($errors->has('profession'))
            <p class="errorMessage">
                <strong>{{ $errors->first('profession') }}</strong>
            </p>
        @endif
        <label>First Name</label>
        <input type="text" name="name" placeholder="Name of physician">
        @if ($errors->has('name'))
            <p class="errorMessage">
                <strong>{{ $errors->first('name') }}</strong>
            </p>
        @endif
        <label>Last Name</label>
        <input type="text" name="lastName" placeholder="Last name">
        @if ($errors->has('lastName'))
            <p class="errorMessage">
                <strong>{{ $errors->first('lastName') }}</strong>
            </p>
        @endif
        <label>Country</label>
        <input type="text" name="country" placeholder="Country name">
        @if ($errors->has('country'))
            <p class="errorMessage">
                <strong>{{ $errors->first('country') }}</strong>
            </p>
        @endif
        <label>Avatar</label>
        <input type="file" name="image" accept=".jpg, .jpeg, .png" placeholder="no">
        <input type="submit" value="submit" name="submit" >
        {!! Form::close() !!}
    </div>
</div>