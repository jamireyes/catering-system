<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_id' => 'required',
            'name' => 'required',
            'role' => 'required',
        ]);

        $member = new Member;
        $member->team_id = $request->team_id;
        $member->name = $request->name;
        $member->role = $request->role;
        $member->save();

        return back()->with('success', 'Added a new member');
    }

    public function show(Member $member)
    {
        //
    }

    public function edit(Member $member)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
        ]);

        $member = Member::find($id);
        $member->name = $request->name;
        $member->role = $request->role;
        $member->save();

        return back()->with('success', 'Updated member');
    }

    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();

        $message = 'Successfully deleted '.$member->name;

        return back()->with('warning', $message);
    }

    public function restore($id)
    {
        $member = Member::withTrashed()->find($id);
        $member->restore();

        $message = 'Successfully restored '.$member->name;

        return back()->with('warning', $message);
    }
}
