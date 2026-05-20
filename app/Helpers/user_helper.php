<?php

use App\Libraries\enums\UserRole;

function user_role(): UserRole
{
    $u = user();
    if (!$u || !isset($u->is_superadmin)) {
        return UserRole::Scanner;
    }
    return UserRole::tryFrom(intval($u->is_superadmin)) ?? UserRole::Scanner;
}

function getUserRole(int|string $role): string
{
    return (UserRole::tryFrom(intval($role)) ?? UserRole::Scanner)->label();
}

function is_wali_kelas(): bool
{
    $u = user();
    return !empty($u->id_guru);
}

function is_superadmin(): bool
{
    return user_role()->isSuperAdmin();
}

function is_kepsek(): bool
{
    return user_role() === UserRole::Kepsek;
}

function can_edit_attendance(): bool
{
    return in_array(user_role(), [UserRole::SuperAdmin, UserRole::StafPetugas]);
}

function can_generate_qr(): bool
{
    return in_array(user_role(), [UserRole::SuperAdmin, UserRole::StafPetugas]);
}

function can_view_report(): bool
{
    return in_array(user_role(), [UserRole::SuperAdmin, UserRole::StafPetugas, UserRole::Kepsek]);
}

