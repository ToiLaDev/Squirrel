<?php

namespace App\Services;

interface EmployeeServiceImpl
{
    public function allRoles();
    public function profileFromRequest($request, $id);
    public function avatarUpload($request, $id);
    public function securityFromRequest($request, $id);
    public function checkNewPassword($id, $oldPassword, $newPassword, $confirmPassword = false);
    public function notifyFromRequest($request, $id);
}
