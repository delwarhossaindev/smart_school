<?php

namespace App\Legacy;

class Session
{
    public function userdata($key = null)
    {
        return $key === null ? session()->all() : session()->get($key);
    }

    public function has_userdata($key)
    {
        return session()->has($key);
    }

    public function set_userdata($key, $value = null)
    {
        foreach (is_array($key) ? $key : [$key => $value] as $name => $item) {
            session()->put($name, $item);
        }
    }

    public function unset_userdata($key)
    {
        session()->forget($key);
    }

    public function all_userdata()
    {
        return session()->all();
    }

    public function set_flashdata($key, $value = null)
    {
        foreach (is_array($key) ? $key : [$key => $value] as $name => $item) {
            session()->flash($name, $item);
        }
    }

    public function flashdata($key = null)
    {
        return $key === null ? session()->all() : session()->get($key);
    }

    public function sess_destroy()
    {
        session()->invalidate();
    }
}
