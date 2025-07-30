<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
     /**
     * Display a listing of the slider items.
     */
    public function index()
    {
        $sliders = Slider::all(); // Fetch all slider items
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new slider item.
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created slider item in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048', // Image is required for new slide
            'subtitle' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'button1_text' => 'nullable|string|max:255',
            'button1_link' => 'nullable|string|max:255',
            'button2_text' => 'nullable|string|max:255',
            'button2_link' => 'nullable|string|max:255',
        ]);

        $slider = new Slider();
        $slider->subtitle = $request->subtitle;
        $slider->title = $request->title;
        $slider->button1_text = $request->button1_text;
        $slider->button1_link = $request->button1_link;
        $slider->button2_text = $request->button2_text;
        $slider->button2_link = $request->button2_link;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'slider_' . time() . '.' . $image->extension(); // Unique name
            $uploadPath = 'uploads/sliders'; // Directory inside public/
            $image->move(public_path($uploadPath), $imageName);
            $slider->image_path = $uploadPath . '/' . $imageName;
        }

        $slider->save();

        session()->flash('success', 'Slider item added successfully!');
        return redirect()->route('admin.sliders.index');
    }

    /**
     * Show the form for editing the specified slider item.
     */
    public function edit(Slider $slider) // Using Route Model Binding
    {
        return view('admin.sliders.edit', compact('slider'));
    }

   /**
     * Update the specified slider item in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'subtitle' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'button1_text' => 'nullable|string|max:255',
            'button1_link' => 'nullable|string|max:255', // <-- Ensure validation is here
            'button2_text' => 'nullable|string|max:255',
            'button2_link' => 'nullable|string|max:255', // <-- Ensure validation is here
        ]);

        $slider->subtitle = $request->subtitle;
        $slider->title = $request->title;
        $slider->button1_text = $request->button1_text;
        $slider->button1_link = $request->button1_link; // <-- ADD/CORRECT THIS LINE
        $slider->button2_text = $request->button2_text;
        $slider->button2_link = $request->button2_link; // <-- ADD/CORRECT THIS LINE

        // Handle image update (this part was correct)
        if ($request->hasFile('image')) {
            if ($slider->image_path && File::exists(public_path($slider->image_path))) {
                File::delete(public_path($slider->image_path));
            }

            $image = $request->file('image');
            $imageName = 'slider_' . time() . '.' . $image->extension();
            $uploadPath = 'uploads/sliders';
            $image->move(public_path($uploadPath), $imageName);
            $slider->image_path = $uploadPath . '/' . $imageName;
        }

        $slider->save();

        session()->flash('success', 'Slider item updated successfully!');
        return redirect()->route('admin.sliders.index');
    }

    /**
     * Remove the specified slider item from storage.
     */
    public function destroy(Slider $slider) // Using Route Model Binding
    {
        // Delete associated image file
        if ($slider->image_path && File::exists(public_path($slider->image_path))) {
            File::delete(public_path($slider->image_path));
        }

        $slider->delete();

        session()->flash('success', 'Slider item deleted successfully!');
        return redirect()->route('admin.sliders.index');
    }
}
