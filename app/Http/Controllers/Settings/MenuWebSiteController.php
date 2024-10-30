<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\MenuWebSite;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MenuWebSiteController extends Controller
{
    public function index(Request $request)
    {
       // try {
            if ($request->isMethod("GET")) {
                $menus = MenuWebSite::with('children')->whereNull('parent_id')->orderBy('order')->get();
                return view('menuWebsite.index', compact('menus'));
            } elseif ($request->isMethod('POST')) {
                $menus = MenuWebSite::with('children')->whereNull('parent_id')->orderBy('order')->get();
                $view = view('menuWebsite.menulist', ['menus' => $menus])->render();
                return response()->json(['message' => 'Menu list updated!', 'listView' => $view]);
            }
       /* } catch (Exception $e) {
            Log::error('Error fetching menu list: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Error fetching menu list.'], 500);
        }*/
    }

    public function store(Request $request)
    {
        //try {
            $validated = $request->validate([
                'name' => 'required|string',
                'name_en' => 'required|string',
                'name_he' => 'required|string',
                'route' => 'nullable|string',
                'icon_svg' => 'nullable|string',
                'parent_id' => 'nullable|exists:menusWebsites,id',
                'order' => 'nullable|integer',
                'permission_name' => 'nullable|string',
            ]);

            MenuWebSite::create($validated);

            return redirect()->route('menuWebsite.index')->with('success', 'Menu updated successfully!');
       /* } catch (Exception $e) {
            Log::error('Error creating menu: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Error creating menu.'], 500);
        }*/
    }

    public function update(Request $request, MenuWebSite $menu)
    {
        try {
            $menu->name = $request->name;
            $menu->name_en = $request->name_en;
            $menu->name_he = $request->name_he;
            $menu->parent_id = $request->parent_id;
            $menu->icon_svg = $request->icon_svg;
            $menu->order = $request->order;
            $menu->permission_name = $request->permission_name;
            $menu->save();

            return redirect()->route('menuWebsite.index')->with('success', 'Menu updated successfully!');
        } catch (Exception $e) {
            Log::error('Error updating menu: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Error updating menu.'], 500);
        }
    }

    public function destroy(MenuWebSite $menu)
    {
        try {
            $menu->delete();
            return response()->json(['status' => true, 'message' => 'Menu deleted successfully!']);
        } catch (Exception $e) {
            Log::error('Error deleting menu: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Error deleting menu.'], 500);
        }
    }

    public function edit(Request $request, MenuWebSite $menu)
    {
        try {
            $menu->load('parent');
            $menus = MenuWebSite::whereNull('parent_id')->get();
            $earnedMenu = [];
            if ($menu->parent)
                $earnedMenu = [$menu->parent->id];

            $createView = view('menuWebsite.addedit_modal', [
                'menu' => $menu,
                'menus' => $menus,
                'earnedMenu' => $earnedMenu
            ])->render();

            return response()->json(['createView' => $createView]);
        } catch (Exception $e) {
            Log::error('Error editing menu: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Error loading edit form.'], 500);
        }
    }
    public function create()
    {
        $menus = MenuWebSite::whereNull('parent_id')->get();

        $createView = view('menuWebsite.create', [
            'menus' => $menus,
        ])->render();

        return response()->json(['createView' => $createView]);
    }


}
