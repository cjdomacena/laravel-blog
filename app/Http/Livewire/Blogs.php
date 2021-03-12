<?php

namespace App\Http\Livewire;



use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Blog;
use App\Models\User;

class Blogs extends Component
{

    public $blogs, $title, $body, $blog_id, $user_id;
    public $is_open = 0;
    /**
     * @var mixed
     */
    private $user;

    public function render()
    {
        //Get Only the Blog Posts that belongs to the User.
        $this->blogs = Blog::query()
        ->where('user_id','=',Auth::user()->id)->get();

        return view('livewire.blogs');
    }


    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }


    public function openModal()
    {
        $this->is_open = true;
    }

    public function closeModal()
    {
        $this->is_open = false;
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->body = '';
        $this->blog_id = '';
    }


    public function store()
    {
        $this->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        //Get the Current User.
        $user = Auth::user();

        //Update or Create a blog related to the user.
        $user->blogs()->updateOrCreate(['id' => $this->blog_id], [
            'title' => $this->title,
            'body' => $this->body
        ]);



        session()->flash(
            'message',
            $this->blog_id ? 'Post Updated Successfully.' : 'Post Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $this->blog_id = $id;
        $this->title = $blog->title;
        $this->body = $blog->body;

        $this->openModal();
    }

    public function delete($id)
    {
        Blog::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }
}
