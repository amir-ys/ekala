<div class="col-lg-4">
    <div class="col-xl-12">
        <div class="card overflow-hidden border border-5">
            <div class="card-header">
                <div class="alert alert-primary" role="alert">
                    ساخت ویژگی جدید
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('panel.attributes.store') }}">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-10 mb-3">
                                <div class="row">
                                    <label for="name" class="col-sm-3 col-form-label">نام</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="نام ویژگی"
                                               value="{{ old('name') }}">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <strong> {{ $message }} </strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 offset-3">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            ذخیره
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
