<?php

namespace App\View\Components\Phone;

use Illuminate\View\Component;

class BottomMenu extends Component
{
    /**
     * The focus type.
     *
     * @var string
     */
    public $focus;


    /**
     * Create a new component instance.
     *
     * @param  string  $focus
     * @return void
     */
    public function __construct($focus='')
    {
        $this->focus = $focus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.phone.bottom-menu');
    }
}
