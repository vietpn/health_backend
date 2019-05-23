<div class="row">
    <div class="col-md-3">
        <?php
        if (!empty($post->photo)) {
            echo Html::image(\App\Models\BaseModel::getImage($post->photo), '', ['style' => 'width:80px; height:80px', 'class' => 'thumbnail profile-user-img img-responsive img-circle']);
        } else {
            echo '<img class="thumbnail profile-user-img img-responsive img-circle" src="http://placehold.it/100x100" alt="" width="100" height="100" />';
        }
        ?>

        <a href="{!! route('backend.profiles.show', $post->profile_id) !!}" class="btn btn-primary"
           style="margin: 10px auto; width: 150px; display: block">{!! trans('app.user_detail') !!}</a>
    </div>


    <div class="col-md-9">
        <table class="table table-striped table-bordered table-hover" style="padding-left: 20px; padding-right: 20px">
            <!-- Profile Name -->
            <tr>
                <td>{!! trans('app.user_name') !!}:</td>
                <td>{!! $post->name !!}</td>
            </tr>

            <!-- Content Field -->
            <tr>
                <td>{!! trans('app.content') !!}:</td>
                <td>{!! $post->content !!}</td>
            </tr>

            <!-- Pin Id Field -->
            <tr>
                <td>{!! trans('app.pin_id') !!}:</td>
                <td>{!! $post->pin_id !!}</td>
            </tr>


            <!-- Longitude Field -->
            <tr>
                <td>{!! trans('app.longitude') !!}:</td>
                <td>{!! $post->longitude !!}</td>
            </tr>


            <!-- Latitude Field -->
            <tr>
                <td>{!! trans('app.latitude') !!}:</td>
                <td>{!! $post->latitude !!}</td>
            </tr>


            <!-- Is Deleted Field -->
            <tr>
                <td>Is Deleted:</td>
                <td>{!! $post->is_deleted !!}</td>
            </tr>


            <!-- Created At Field -->
            <tr>
                <td>{!! trans('app.created_at') !!}:</td>
                <td>{!! $post->created_at !!}</td>
            </tr>


            <!-- Updated At Field -->
            <tr>
                <td>{!! trans('app.updated_at') !!}:</td>
                <td>{!! $post->updated_at !!}</td>
            </tr>

            <tr>
                <td>{!! trans('app.like') !!}:</td>
                <td>{!! $post->likes !!}</td>
            </tr>
            <tr>
                <td>
                    <a href="{!! route('backend.comments.index', $post->id) !!}" class="btn btn-primary"
                       style="margin: 10px auto;">{!! trans('app.comment') !!}</a>
                </td>
                <td>{!! $post->comments !!}</td>
            </tr>
            <tr>
                <td>{!! trans('app.view') !!}:</td>
                <td>{!! $post->views !!}</td>
            </tr>
            <tr>
                <?php if(!empty($post->reports)):?>
                <td style="color: red">{!! trans('app.report') !!}</td>
                <?php else:?>
                <td>{!! trans('app.report') !!}</td>
                <?php endif;?>
                <td></td>
            </tr>
        </table>
    </div>
</div>