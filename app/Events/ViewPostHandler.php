<?php

namespace App\Events;

use Illuminate\Session\Store;

class ViewPostHandler {
    private $session;

    public function __construct(Store $session) {
        $this->session = $session;
    }

    public function handle($post) {
        if (!$this->isPostViewed($post)) {
            $post->increment('count_view');
            $this->storePost($post);
        }
    }

    private function isPostViewed($post) {
        $viewed = $this->session->get('viewed_posts', []);
        return array_key_exists($post->id, $viewed);
    }

    private function storePost($post) {
        $key = 'viewed_posts.' . $post->id;
        $this->session->put($key, time());
    }
}