<div class="form-group">
    <p> انتخاب ویژگی های محصول</p>
    <div class="row ">
        <div class="col-md-4 offset-4 mb-3">
            <label>انتخاب دسته بندی محصول</label>
            <select class="form-control" id="category_id" name="category_id">
                <option value>  انتخاب  دسته بندی </option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                            @if($category->id == old('category_id')) selected @endif
                    > {{ $category->name }} </option>
                @endforeach
            </select>
            <x-validation-error field="category_id"/>
        </div>
    </div>

    <div class="row" id="category-row">

    </div>
    <hr>
</div>
'attribute_ids.*' => ['required'] ,
