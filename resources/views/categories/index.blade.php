@extends('layouts.app', ['title' => 'Tags Index'])
@section('content')
    <div id="categories" class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-rbec">
                    <div class="panel-heading"><h2>Tag<a href="#" class="btn-add btn btn-primary pull-right"
                                                                data-toggle="modal"
                                                                data-target="#addCategoryModal">Add Tag +</a></h2>
                    </div>
                    @include('partials.success-message')
                    @include('partials.errors')
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->category}}</td>
                                        <td>{{ $category->created_at->diffForHumans() }}</td>
                                        <td><a href="#" id="tag{{ $category->id }}" class="btn btn-default pull-left"
                                               data-toggle="modal" data-target="#editCategoryModal" style="margin-right:5px"
                                               @click="setActiveCategory({{ $category->id }}, '{{ $category->category }}', '{{ $category->description }}')"><i
                                                        class="fa fa-edit"></i></a>
                                            <form action="/categories/{{ $category->id }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button class="btn btn-danger"><i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                    </div>
                    <div class="panel-footer">
                        {{ $categories->render() }}
                    </div>
                </div>
            </div>
        </div>

        <div id="addCategoryModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="resetData"
                        ><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Tag</h4>
                    </div>
                    <div class="modal-body">
                        <form id="addCategoryForm" action="/categories" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Tag<span class="text-danger">*</span></label>
                                <input v-model="category" type="text" name="category" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Description (Optional)</label>
                                <input v-model="description" type="text" name="description" class="form-control">
                            </div>
                        </form>
                        <div v-show="hasErrors" class="alert alert-danger">
                            <li v-for="error in errors">@{{ error }}</li>

                        </div>
                        @include('partials.errors')
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

        <div id="editCategoryModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        ><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Tag</h4>
                    </div>
                    <div class="modal-body">
                        <form id="editCategoryForm" :action="'/categories/'+activeCategory.id" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Tag<span class="text-danger">*</span></label>
                                <input v-model="activeCategory.category" type="text" name="category"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input v-model="activeCategory.description" type="text" name="description"
                                       class="form-control">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary" @click="editCategory">
                            Save
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
            el: '#categories',
            data: {
                category: '',
                description: '',
                activeCategory: {
                    id: '',
                    category: '',
                    description: ''
                },
                hasErrors: false,
                errors: []
            },
            methods: {
                resetData: function () {
                    this.category = '';
                    this.description = '';
                    this.resetErrors();
                },
                setActiveCategory: function (id, category, description) {
                    this.activeCategory.id = id;
                    this.activeCategory.category = category;
                    this.activeCategory.description = description;
                },
                addCategory: function () {
                    this.checkErrors();

                    if (!this.hasErrors) {
                        document.getElementById('addCategoryForm').submit();
                    }
                },
                editCategory: function () {
                    document.getElementById('editCategoryForm').submit();
                },
                checkErrors: function () {
                    this.resetErrors();

                    if (this.category == '') {
                        this.hasErrors = true;
                        this.errors.push('Category field is required');
                    }
                },
                resetErrors: function () {
                    this.hasErrors = false;
                    this.errors = [];
                },
            }
        })
    </script>
@endsection