<?php
return $ui = [
    'pageBg' => 'bg-slate-100 text-slate-800',
    'card' => 'bg-white border border-slate-200 rounded-xl shadow-sm',
    'cardHeader' => 'px-6 py-4 border-b border-slate-200',
    'cardBody' => 'p-6',
    'title' => 'text-xl md:text-2xl font-semibold text-slate-900',
    'subtitle' => 'text-sm text-slate-500',
    'label' => 'block text-sm font-medium text-slate-700 mb-1',
    'input' => 'w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:border-slate-400',
    'textarea' => 'w-full min-h-32 rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:border-slate-400',
    'btnPrimary' => 'inline-flex items-center justify-center gap-2 rounded-lg bg-slate-800 px-4 py-2 text-sm font-medium text-white hover:bg-slate-700 transition-colors',
    'btnSecondary' => 'inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors',
    'btnDanger' => 'inline-flex items-center justify-center gap-2 rounded-lg bg-red-700 px-4 py-2 text-sm font-medium text-white hover:bg-red-600 transition-colors',
    'btnWarning' => 'inline-flex items-center justify-center gap-2 rounded-lg bg-orange-200 px-4 py-2 text-sm font-medium text-orange-800 hover:bg-orange-300 text-orange-900 transition-colors',
    'badgeActive' => 'inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-medium text-emerald-700',
    'badgeInactive' => 'inline-flex rounded-full bg-slate-200 px-2.5 py-1 text-xs font-medium text-slate-600',
    'badgeOk' => 'inline-flex rounded-full bg-blue-100 px-2.5 py-1 text-xs font-medium text-blue-700',
    'badgeWarning' => 'inline-flex rounded-full bg-amber-100 px-2.5 py-1 text-xs font-medium text-amber-700',
    'badgeDanger' => 'inline-flex rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-700',
    'tableWrap' => 'overflow-x-auto border border-slate-200 rounded-xl',
    'table' => 'min-w-full divide-y divide-slate-200 bg-white',
    'th' => 'px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 bg-slate-50',
    'td' => 'px-4 py-3 text-sm text-slate-700 border-t border-slate-100',
    'sidebarItem' => 'flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-slate-200 hover:bg-slate-700/60',
    'sidebarItemActive' => 'flex items-center gap-3 rounded-lg bg-slate-700 px-3 py-2 text-sm font-medium text-white',
    'filterBtn' => 'rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50',
    'filterBtnActive' => 'rounded-lg border border-slate-800 bg-slate-800 px-3 py-2 text-sm font-medium text-white',
    'errorText' => 'text-red-500 text-red-600 transition-colors text-sm',
    'successText' => 'text-emerald-500 text-emerald-600 transition-colors text-sm',
    'btnVariants' => [
        'success' => [
            [
                'name' => 'Emerald Solid',
                'icon' => 'check-circle',
                'class' => 'inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-500 transition-colors',
            ],
            [
                'name' => 'Green Soft',
                'icon' => 'sparkles',
                'class' => 'inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-100 px-4 py-2 text-sm font-medium text-emerald-800 hover:bg-emerald-200 transition-colors',
            ],
            [
                'name' => 'Teal Outline',
                'icon' => 'shield-check',
                'class' => 'inline-flex items-center justify-center gap-2 rounded-lg border border-teal-600 bg-white px-4 py-2 text-sm font-medium text-teal-700 hover:bg-teal-50 transition-colors',
            ],
        ],
        'warning' => [
            [
                'name' => 'Amber Solid',
                'icon' => 'triangle-alert',
                'class' => 'inline-flex items-center justify-center gap-2 rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400 transition-colors',
            ],
            [
                'name' => 'Orange Soft',
                'icon' => 'alert-circle',
                'class' => 'inline-flex items-center justify-center gap-2 rounded-lg bg-orange-100 px-4 py-2 text-sm font-medium text-orange-800 hover:bg-orange-200 transition-colors',
            ],
            [
                'name' => 'Yellow Outline',
                'icon' => 'bell-ring',
                'class' => 'inline-flex items-center justify-center gap-2 rounded-lg border border-yellow-500 bg-white px-4 py-2 text-sm font-medium text-yellow-700 hover:bg-yellow-50 transition-colors',
            ],
        ],
        'error' => [
            [
                'name' => 'Red Solid',
                'icon' => 'x-circle',
                'class' => 'inline-flex items-center justify-center gap-2 rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-500 transition-colors',
            ],
            [
                'name' => 'Rose Soft',
                'icon' => 'ban',
                'class' => 'inline-flex items-center justify-center gap-2 rounded-lg bg-rose-100 px-4 py-2 text-sm font-medium text-rose-800 hover:bg-rose-200 transition-colors',
            ],
            [
                'name' => 'Crimson Outline',
                'icon' => 'octagon-alert',
                'class' => 'inline-flex items-center justify-center gap-2 rounded-lg border border-red-700 bg-white px-4 py-2 text-sm font-medium text-red-700 hover:bg-red-50 transition-colors',
            ],
        ],
    ],
];
