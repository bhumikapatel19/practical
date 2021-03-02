<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Blog;
use Image;

class BlogJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;
        if(!empty($data['image']))
        {
            $path = UPLOAD_IMAGE_PATH.'/blogs';
            if(!file_exists($path))
            {
                mkdir($path,0777);
            }else{
                chmod($path,0777);
            }

            $image = $data['image'];
            $image_name = time().'.jpg';
            $save_image = Image::make($image->getRealPath());
            $save_image->save($path.'/'.$image_name);
            chmod($path.'/'.$image_name,0777);

            $data['image'] = $image_name;
        }

        $blog_save = Blog::firstOrNew(['id'=>$data['id']]);
        $blog_save->fill($data);
        $blog_save->save();

        return;
    }
}
