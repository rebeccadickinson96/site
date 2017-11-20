@extends('layouts.app', ['title' => 'Edit a post'])
@section('content')
    <div class="container" id="editPost">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="/posts/{{$post->id}}">

                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                               value="{{ old('title', $post->title) }}">
                    </div>

                    <div class="form-group">
                        <label for="body">Post</label>
                        <textarea class="form-control" id="body" name="body">{{ old('body', $post->body) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="date_published">Date Created</label>
                        <input type="text" class="form-control timepicker" id="date_published" name="date_published"
                               value="{{ old('date_published', $post->date_published ? $post->date_published->format('d/m/Y H:i') :Carbon\Carbon::now()->format('d/m/Y H:i')) }}">
                    </div>

                    <div class="form group">
                        <select name="published">
                            <option disabled>Please select...</option>
                            <option value="1" @if($post->published == 1) selected @endif>Published</option>
                            <option value="0" @if($post->published == 0) selected @endif>Draft</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Post Tags</label>
                        <div class="categories" id="categoriesEdit">
                            @foreach($categories as $category)
                                <div class="checkbox col-xs-12">
                                    <label class=@if($category->id == $post->categoryPost->contains('category_id', $category->id))
                                            checked
                                            @endif>
                                        <input type="checkbox" name="categories[{{ $category->id }}][category]"
                                               value="{{ $category->id }}"
                                               @if($category->id == $post->categoryPost->contains('category_id', $category->id))
                                               checked
                                                @endif
                                        >
                                        {{ $category->category }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <a href="#" data-toggle="modal" data-target="#editCategoryModal" class="btn-add btn btn-primary">
                            Add tag
                        </a>
                    </div>

                    @include ('partials.errors')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
        <div id="editCategoryModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="resetData"
                        ><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Tag</h4>
                    </div>
                    <div class="modal-body">
                        <form id="editCategoryForm" action="/posts/create/categories" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Tag<span class="text-danger">*</span></label>
                                <input v-model="category" type="text" name="category" class="form-control">
                            </div>
                        </form>
                        <div v-show="hasErrors" class="alert alert-danger">
                            <li v-for="error in errors">@{{ error }}</li>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" @click="resetData">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary" @click="addCategory">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('vue-mixins')
    <script>
        new Vue({
            el: '#editPost',
            data: {
                category: '',
                hasErrors: false,
                errors: []
            },
            methods: {
                resetData: function () {
                    this.category = '';
                    this.resetErrors();
                },

                addCategory: function () {
                    let module = this;
                    axios.post('/posts/create/categories',{
                        category: this.category
                    })
                        .then(function (response) {
                            var $categories = $('#categoriesEdit');
                            if(!$categories.has('.checkbox').length){
                                $categories.html('');
                            }
                            $('#editCategoryModal').modal('hide');
                            $categories.append('<div class="checkbox col-xs-12">' +
                                '<label><input type="checkbox" name="categories['+ response.data.id +'][category]" value="'+ response.data.id +'"> '+ response.data.category +'</label></div>');
                        })
                        .catch(function (error) {
                            module.hasErrors = true;
                            module.errors.push('' + error.response.data.category + '');
                        });

                    this.resetData();
                },
                resetErrors: function () {
                    this.hasErrors = false;
                    this.errors = [];
                }
            }
        })
    </script>
@endsection