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

    /**
     * Only returns values stored as flash data. error() and success() keep the same key
     * names in plain userdata, and those must not show up here.
     */
    public function flashdata($key = null)
    {
        $flashKeys = array_merge(session()->get('_flash.old', []), session()->get('_flash.new', []));

        if ($key !== null) {
            return in_array($key, $flashKeys, true) ? session()->get($key) : null;
        }

        return session()->only($flashKeys);
    }

    public function sess_destroy()
    {
        session()->invalidate();
    }
}
