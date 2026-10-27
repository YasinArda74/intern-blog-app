<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tags\StoreTagsRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;

class TagController extends Controller
{
    public function getList()
    {
        $tags = Tag::query()->paginate(10);

        return view('admin.tags.index', [
            'tags' => $tags,
        ]);
    }

    public function getCreate()
    {
        $tags = Tag::query()->get();

        return view('admin.tags.create', [],[
            'tags' => $tags,
        ]);
    }

    public function postCreate(StoreTagsRequest $request)
    {
        try {
            Tag::query()->create($request->validated());
        }catch (\Exception $exception){
            Log::error($exception);
            return $this->returnErrorResponse('An error occurred while creating the tag.');
        }
        return $this->returnSuccessResponse('Tag created successfully.', route('admin.tags.list'));



    }

    public function putUpdate(Tag $tag, StoreTagsRequest $request)
    {
        try {
           $tag->update($request->validated());

        } catch (\Exception $exception) {
            Log::error('Tag creation error: ' . $exception);

            return $this->returnErrorResponse('An error occurred while updating the Tag.');
        }

        return $this->returnSuccessResponse('Tag updated successfully.', route('admin.tags.list'));
    }

    public function getUpdate(Tag $tag)
    {
        $tags = Tag::query()->get();

        return view('admin.tags.create',[
            'tags' => $tags,
            'tag' => $tag,
        ]);
    }

    public function deleteTag(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.tags.list');
    }
}
