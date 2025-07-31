<script>
    const STUtxt = {
        'ttl_ph': '{{__("stu.ttl_ph")}}',
        'sttl_ph': '{{__("stu.sttl_ph")}}',
        'ttl_lb': '{{__("stu.ttl_lb")}}',
        'sttl_lb': '{{__("stu.sttl_lb")}}',

        'lv_lb': '{{__("stu.lv_lb")}}',

        'create_link': '{{__("stu.create_link")}}',
        'reset': '{{__("stu.reset")}}',
        'msg' : {
            'generating_link': '{{ __("stu.msg.generating_link") }}',
            'link_created': '{{ __("stu.msg.link_created") }}',
            'loading_image': '{{ __("stu.msg.loading_image") }}',
            'invalid_image': '{{ __("stu.msg.invalid_image") }}',
            'reset_successful': '{{ __("stu.msg.reset_successful") }}',
            'confirm_reset_template': '{{ __("stu.msg.confirm_reset_template") }}',
            'url_copied': '{{ __("stu.msg.url_copied") }}',
            'copy_url_unsupported': '{{ __("stu.msg.copy_url_unsupported") }}',
            'url_required': '{{ __("stu.msg.url_required") }}',
            'url_disallowed': '{{ __("stu.msg.url_disallowed") }}',
            'url_allowed_domains': '{{ __("stu.msg.url_allowed_domains") }}',
            'datetime_invalid': '{{ __("stu.msg.datetime_invalid") }}',
        }
    };

const fbSTU = {
    yt: {
        tx: '{{ __('stu.yt.name') }}',
        clr: '#ff0000',
        sclr: '#9f0000',
        dt: [{
                id: 'g_yt1',
                name: '{{ __('stu.yt.dt.g_yt1.name') }}',
                fi: [{
                    i: 'yt1',
                    t: 'url',
                    ic: 'yt',
                    r: 1,
                    ph: '{{ __('stu.yt.dt.g_yt1.fi.yt1.placeholder') }}',
                    label: '{{ __('stu.yt.dt.g_yt1.fi.yt1.label') }}',
                    df: ['youtube.com/@', 'youtube.com/channel', 'youtube.com/c']
                }]
            },
            {
                id: 'g_yt2',
                name: '{{ __('stu.yt.dt.g_yt2.name') }}',
                fi: [{
                    i: 'yt2',
                    t: 'url',
                    ic: 'yt',
                    r: 1,
                    ph: '{{ __('stu.yt.dt.g_yt2.fi.yt2.placeholder') }}',
                    label: '{{ __('stu.yt.dt.g_yt2.fi.yt2.label') }}',
                    df: ['youtube.com/@', 'youtube.com/channel', 'youtube.com/c']
                }]
            },
            {
                id: 'g_yt3',
                name: '{{ __('stu.yt.dt.g_yt3.name') }}',
                fi: [{
                    i: 'yt3',
                    t: 'url',
                    ic: 'yt',
                    r: 1,
                    ph: '{{ __('stu.yt.dt.g_yt2.fi.yt2.placeholder') }}',
                    label: '{{ __('stu.yt.dt.g_yt2.fi.yt2.label') }}',
                    df: ['youtube.com/@', 'youtube.com/channel', 'youtube.com/c']
                }]
            },
            {
                id: 'g_ytl1',
                name: '{{ __('stu.yt.dt.g_ytl1.name') }}',
                fi: [{
                    i: 'ytl1',
                    t: 'url',
                    ic: 'like',
                    r: 1,
                    df: ['youtube.com/watch?v=', 'youtu.be'],
                    ph: '{{ __('stu.yt.dt.g_ytl1.fi.ytl1.placeholder') }}',
                    label: '{{ __('stu.yt.dt.g_ytl1.fi.ytl1.label') }}',
                }],
            },
            {
                id: 'g_ytl2',
                name: '{{ __('stu.yt.dt.g_ytl2.name') }}',
                fi: [{
                    i: 'ytl2',
                    t: 'url',
                    ic: 'like',
                    r: 1,
                    df: ['youtube.com/watch?v=', 'youtu.be'],
                    ph: '{{ __('stu.yt.dt.g_ytl2.fi.ytl2.placeholder') }}',
                    label: '{{ __('stu.yt.dt.g_ytl2.fi.ytl2.label') }}',
                }],
            },
            {
                id: 'g_ytl3',
                name: '{{ __('stu.yt.dt.g_ytl3.name') }}',
                fi: [{
                    i: 'ytl3',
                    t: 'url',
                    ic: 'like',
                    r: 1,
                    df: ['youtube.com/watch?v=', 'youtu.be'],
                    ph: '{{ __('stu.yt.dt.g_ytl3.fi.ytl3.placeholder') }}',
                    label: '{{ __('stu.yt.dt.g_ytl3.fi.ytl3.label') }}',
                }],
            },
            {
                id: 'g_ytc1',
                name: '{{ __('stu.yt.dt.g_ytc1.name') }}',
                fi: [{
                    i: 'ytc1',
                    t: 'url',
                    ic: 'cm',
                    r: 1,
                    df: ['youtube.com/watch?v=', 'youtu.be'],
                    ph: '{{ __('stu.yt.dt.g_ytc1.fi.ytc1.placeholder') }}',
                    label: '{{ __('stu.yt.dt.g_ytc1.fi.ytc1.label') }}',
                }],
            },
            {
                id: 'g_ytc2',
                name: '{{ __('stu.yt.dt.g_ytc2.name') }}',
                fi: [{
                    i: 'ytc2',
                    t: 'url',
                    ic: 'cm',
                    r: 1,
                    df: ['youtube.com/watch?v=', 'youtu.be'],
                    ph: '{{ __('stu.yt.dt.g_ytc2.fi.ytc2.placeholder') }}',
                    label: '{{ __('stu.yt.dt.g_ytc2.fi.ytc2.label') }}',
                }],
            }
        ],
    },

    tg: {
        tx: '{{ __('stu.tlg.name') }}',
        clr: '#0088cc',
        sclr: '#186389',
        df: ['t.me'],
        dt: [{
                id: 'g_tg1',
                name: '{{ __('stu.tlg.actions.g_tg1.name') }}',
                fi: [{
                    i: 'tg1',
                    t: 'url',
                    ic: 'tg',
                    r: 1,
                    ph: '{{ __('stu.tlg.actions.g_tg1.fi.tg1.placeholder') }}',
                    label: '{{ __('stu.tlg.actions.g_tg1.fi.tg1.label') }}',
                }]
            },
            {
                id: 'g_tg2',
                name: '{{ __('stu.tlg.actions.g_tg2.name') }}',
                fi: [{
                    i: 'tg2',
                    t: 'url',
                    ic: 'tg',
                    r: 1,
                    ph: '{{ __('stu.tlg.actions.g_tg2.fi.tg2.placeholder') }}',
                    label: '{{ __('stu.tlg.actions.g_tg2.fi.tg2.label') }}',
                }]
            },
            {
                id: 'g_tg3',
                name: '{{ __('stu.tlg.actions.g_tg3.name') }}',
                fi: [{
                    i: 'tg3',
                    t: 'url',
                    ic: 'tg',
                    r: 1,
                    ph: '{{ __('stu.tlg.actions.g_tg3.fi.tg3.placeholder') }}',
                    label: '{{ __('stu.tlg.actions.g_tg3.fi.tg3.label') }}',
                }]
            },
        ],
    },

    tk: {
        tx: '{{ __('stu.tt.name') }}',
        clr: '#000000',
        sclr: '#363636',
        df: ['tiktok.com'],
        dt: [{
                id: 'g_tk1',
                name: '{{ __('stu.tt.actions.g_tk1.name') }}',
                fi: [{
                    i: 'tk1',
                    t: 'url',
                    ic: 'tk',
                    r: 1,
                    ph: '{{ __('stu.tt.actions.g_tk1.fi.tk1.placeholder') }}',
                    label: '{{ __('stu.tt.actions.g_tk1.fi.tk1.label') }}',
                }]
            },
            {
                id: 'g_tk2',
                name: '{{ __('stu.tt.actions.g_tk2.name') }}',
                fi: [{
                    i: 'tk2',
                    t: 'url',
                    ic: 'tk',
                    r: 1,
                    ph: '{{ __('stu.tt.actions.g_tk2.fi.tk2.placeholder') }}',
                    label: '{{ __('stu.tt.actions.g_tk2.fi.tk2.label') }}',
                }]
            },
            {
                id: 'g_tk3',
                name: '{{ __('stu.tt.actions.g_tk3.name') }}',
                fi: [{
                    i: 'tk3',
                    t: 'url',
                    ic: 'tk',
                    r: 1,
                    ph: '{{ __('stu.tt.actions.g_tk3.fi.tk3.placeholder') }}',
                    label: '{{ __('stu.tt.actions.g_tk3.fi.tk3.label') }}',
                }]
            },
            {
                id: 'g_tkl1',
                name: '{{ __('stu.tt.actions.g_tkl1.name') }}',
                fi: [{
                    i: 'tkl1',
                    t: 'url',
                    ic: 'tk',
                    r: 1,
                    ph: '{{ __('stu.tt.actions.g_tkl1.fi.tkl1.placeholder') }}',
                    label: '{{ __('stu.tt.actions.g_tkl1.fi.tkl1.label') }}',
                }]
            },
            {
                id: 'g_tkl2',
                name: '{{ __('stu.tt.actions.g_tkl2.name') }}',
                fi: [{
                    i: 'tkl2',
                    t: 'url',
                    ic: 'tk',
                    r: 1,
                    ph: '{{ __('stu.tt.actions.g_tkl2.fi.tkl2.placeholder') }}',
                    label: '{{ __('stu.tt.actions.g_tkl2.fi.tkl2.label') }}',
                }]
            },
            {
                id: 'g_tkl3',
                name: '{{ __('stu.tt.actions.g_tkl3.name') }}',
                fi: [{
                    i: 'tkl3',
                    t: 'url',
                    ic: 'tk',
                    r: 1,
                    ph: '{{ __('stu.tt.actions.g_tkl3.fi.tkl3.placeholder') }}',
                    label: '{{ __('stu.tt.actions.g_tkl3.fi.tkl3.label') }}',
                }]
            },
            {
                id: 'g_tkc1',
                name: '{{ __('stu.tt.actions.g_tkc1.name') }}',
                fi: [{
                    i: 'tkc1',
                    t: 'url',
                    ic: 'tk',
                    r: 1,
                    ph: '{{ __('stu.tt.actions.g_tkc1.fi.tkc1.placeholder') }}',
                    label: '{{ __('stu.tt.actions.g_tkc1.fi.tkc1.label') }}',
                }]
            },
            {
                id: 'g_tkc2',
                name: '{{ __('stu.tt.actions.g_tkc2.name') }}',
                fi: [{
                    i: 'tkc2',
                    t: 'url',
                    ic: 'tk',
                    r: 1,
                    ph: '{{ __('stu.tt.actions.g_tkc2.fi.tkc2.placeholder') }}',
                    label: '{{ __('stu.tt.actions.g_tkc2.fi.tkc2.label') }}',
                }]
            },
            {
                id: 'g_tkr1',
                name: '{{ __('stu.tt.actions.g_tkr1.name') }}',
                fi: [{
                    i: 'tkr1',
                    t: 'url',
                    ic: 'tk',
                    r: 1,
                    ph: '{{ __('stu.tt.actions.g_tkr1.fi.tkr1.placeholder') }}',
                    label: '{{ __('stu.tt.actions.g_tkr1.fi.tkr1.label') }}',
                }]
            },
            {
                id: 'g_tkr2',
                name: '{{ __('stu.tt.actions.g_tkr2.name') }}',
                fi: [{
                    i: 'tkr2',
                    t: 'url',
                    ic: 'tk',
                    r: 1,
                    ph: '{{ __('stu.tt.actions.g_tkr2.fi.tkr2.placeholder') }}',
                    label: '{{ __('stu.tt.actions.g_tkr2.fi.tkr2.label') }}',
                }]
            }
        ],
    },

    ig: {
        tx: '{{ __('stu.ig.name') }}',
        clr: '#5851DB',
        sclr: '#3E39A6',
        df: ['instagram.com'],
        dt: [{
                id: 'g_ig1',
                name: '{{ __('stu.ig.actions.g_ig1.name') }}',
                fi: [{
                    i: 'ig1',
                    t: 'url',
                    ic: 'ig',
                    r: 1,
                    ph: '{{ __('stu.ig.actions.g_ig1.fi.ig1.placeholder') }}',
                    label: '{{ __('stu.ig.actions.g_ig1.fi.ig1.label') }}',
                }]
            },
            {
                id: 'g_ig2',
                name: '{{ __('stu.ig.actions.g_ig2.name') }}',
                fi: [{
                    i: 'ig2',
                    t: 'url',
                    ic: 'ig',
                    r: 1,
                    ph: '{{ __('stu.ig.actions.g_ig2.fi.ig2.placeholder') }}',
                    label: '{{ __('stu.ig.actions.g_ig2.fi.ig2.label') }}',
                }]
            },
            {
                id: 'g_ig3',
                name: '{{ __('stu.ig.actions.g_ig3.name') }}',
                fi: [{
                    i: 'ig3',
                    t: 'url',
                    ic: 'ig',
                    r: 1,
                    ph: '{{ __('stu.ig.actions.g_ig3.fi.ig3.placeholder') }}',
                    label: '{{ __('stu.ig.actions.g_ig3.fi.ig3.label') }}',
                }]
            },
            {
                id: 'g_igl1',
                name: '{{ __('stu.ig.actions.g_igl1.name') }}',
                fi: [{
                    i: 'igl1',
                    t: 'url',
                    ic: 'ig',
                    r: 1,
                    ph: '{{ __('stu.ig.actions.g_ig1.fi.ig1.placeholder') }}',
                    label: '{{ __('stu.ig.actions.g_ig1.fi.ig1.label') }}',
                }]
            },
            {
                id: 'g_igl2',
                name: '{{ __('stu.ig.actions.g_igl2.name') }}',
                fi: [{
                    i: 'igl2',
                    t: 'url',
                    ic: 'ig',
                    r: 1,
                    ph: '{{ __('stu.ig.actions.g_ig2.fi.ig2.placeholder') }}',
                    label: '{{ __('stu.ig.actions.g_ig2.fi.ig2.label') }}',
                }]
            },
            {
                id: 'g_igl3',
                name: '{{ __('stu.ig.actions.g_igl3.name') }}',
                fi: [{
                    i: 'igl3',
                    t: 'url',
                    ic: 'ig',
                    r: 1,
                    ph: '{{ __('stu.ig.actions.g_igl3.fi.igl3.placeholder') }}',
                    label: '{{ __('stu.ig.actions.g_igl3.fi.igl3.label') }}',
                }]
            },
        ],
    },

    fb: {
        tx: '{{ __('stu.fb.name') }}',
        clr: '#395693',
        sclr: '#1d2c4b',
        df: ['facebook.com'],
        dt: [{
                id: 'g_fb1',
                name: '{{ __('stu.fb.actions.g_fb1.name') }}',
                fi: [{
                    i: 'fb1',
                    t: 'url',
                    ic: 'fb',
                    r: 1,
                    ph: '{{ __('stu.fb.actions.g_fb1.fi.fb1.placeholder') }}',
                    label: '{{ __('stu.fb.actions.g_fb1.fi.fb1.label') }}',
                }]
            },
            {
                id: 'g_fb2',
                name: '{{ __('stu.fb.actions.g_fb2.name') }}',
                fi: [{
                    i: 'fb2',
                    t: 'url',
                    ic: 'fb',
                    r: 1,
                    ph: '{{ __('stu.fb.actions.g_fb2.fi.fb2.placeholder') }}',
                    label: '{{ __('stu.fb.actions.g_fb2.fi.fb2.label') }}',
                }]
            },
            {
                id: 'g_fb3',
                name: '{{ __('stu.fb.actions.g_fb3.name') }}',
                fi: [{
                    i: 'fb3',
                    t: 'url',
                    ic: 'fb',
                    r: 1,
                    ph: '{{ __('stu.fb.actions.g_fb3.fi.fb3.placeholder') }}',
                    label: '{{ __('stu.fb.actions.g_fb3.fi.fb3.label') }}',
                }]
            },
            {
                id: 'g_fbl1',
                name: '{{ __('stu.fb.actions.g_fbl1.name') }}',
                fi: [{
                    i: 'fbl1',
                    t: 'url',
                    ic: 'fb',
                    r: 1,
                    ph: '{{ __('stu.fb.actions.g_fbl1.fi.fbl1.placeholder') }}',
                    label: '{{ __('stu.fb.actions.g_fbl1.fi.fbl1.label') }}',
                }]
            },
            {
                id: 'g_fbl2',
                name: '{{ __('stu.fb.actions.g_fbl2.name') }}',
                fi: [{
                    i: 'fbl2',
                    t: 'url',
                    ic: 'fb',
                    r: 1,
                    ph: '{{ __('stu.fb.actions.g_fbl2.fi.fbl2.placeholder') }}',
                    label: '{{ __('stu.fb.actions.g_fbl2.fi.fbl2.label') }}',
                }]
            },
            {
                id: 'g_fbl3',
                name: '{{ __('stu.fb.actions.g_fbl3.name') }}',
                fi: [{
                    i: 'fbl3',
                    t: 'url',
                    ic: 'fb',
                    r: 1,
                    ph: '{{ __('stu.fb.actions.g_fbl3.fi.fbl3.placeholder') }}',
                    label: '{{ __('stu.fb.actions.g_fbl3.fi.fbl3.label') }}',
                }]
            },
        ],
    },
    tw: {
      tx: 'X',
      clr: '#000000',
      sclr: '#1a1a1a',
      df: ['x.com'],
      fb: 1,
      dt: [
        { id: 'g_tw1', name: 'Follow #1', fi: [{ i: 'tw1', t: 'url', ic: 'tw', r: 1 }] },
        { id: 'g_tw2', name: 'Follow #2', fi: [{ i: 'tw2', t: 'url', ic: 'tw', r: 1 }] },
        { id: 'g_tw3', name: 'Follow #3', fi: [{ i: 'tw3', t: 'url', ic: 'tw', r: 1 }] },
        { id: 'g_twl1', name: 'Like #1', fi: [{ i: 'twl1', t: 'url', ic: 'like', r: 1 }] },
        { id: 'g_twl2', name: 'Like #2', fi: [{ i: 'twl2', t: 'url', ic: 'like', r: 1 }] },
        { id: 'g_twl3', name: 'Like #3', fi: [{ i: 'twl3', t: 'url', ic: 'like', r: 1 }] },
      ],
    },
    zl: {
        tx: '{{ __('stu.zl.name') }}',
        clr: '#2d62ff',
        sclr: '#4E6397',
        df: ['zalo.com'],
        dt: [{
                id: 'g_zl1',
                name: '{{ __('stu.zl.join_group_1.name') }}',
                fi: [{
                    i: 'zl1',
                    t: 'url',
                    ic: 'zl',
                    r: 1,
                    ph: '{{ __('stu.zl.join_group_1.placeholder') }}',
                    label: '{{ __('stu.zl.join_group_1.label') }}'
                }]
            },
            {
                id: 'g_zl2',
                name: '{{ __('stu.zl.join_group_2.name') }}',
                fi: [{
                    i: 'zl2',
                    t: 'url',
                    ic: 'zl',
                    r: 1,
                    ph: '{{ __('stu.zl.join_group_2.placeholder') }}',
                    label: '{{ __('stu.zl.join_group_2.label') }}'
                }]
            },
            {
                id: 'g_zl3',
                name: '{{ __('stu.zl.join_group_2.name') }}',
                fi: [{
                    i: 'zl3',
                    t: 'url',
                    ic: 'zl',
                    r: 1,
                    ph: '{{ __('stu.zl.join_group_3.placeholder') }}',
                    label: '{{ __('stu.zl.join_group_3.label') }}'
                }]
            },
        ],
    },
    dc: {
        tx: '{{ __('stu.dcd.name') }}',
        clr: '#7289DA',
        sclr: '#4E6397',
        df: ['discord.com'],
        dt: [{
                id: 'g_dc1',
                name: '{{ __('stu.dcd.actions.g_dc1.name') }}',
                fi: [{
                    i: 'dc1',
                    t: 'url',
                    ic: 'dc',
                    r: 1,
                    ph: '{{ __('stu.dcd.actions.g_dc1.fi.dc1.placeholder') }}',
                    label: '{{ __('stu.dcd.actions.g_dc1.fi.dc1.label') }}',
                }]
            },
            {
                id: 'g_dc2',
                name: '{{ __('stu.dcd.actions.g_dc2.name') }}',
                fi: [{
                    i: 'dc2',
                    t: 'url',
                    ic: 'dc',
                    r: 1,
                    ph: '{{ __('stu.dcd.actions.g_dc2.fi.dc2.placeholder') }}',
                    label: '{{ __('stu.dcd.actions.g_dc2.fi.dc2.label') }}',
                }]
            },
            {
                id: 'g_dc3',
                name: '{{ __('stu.dcd.actions.g_dc3.name') }}',
                fi: [{
                    i: 'dc3',
                    t: 'url',
                    ic: 'dc',
                    r: 1,
                    ph: '{{ __('stu.dcd.actions.g_dc3.fi.dc3.placeholder') }}',
                    label: '{{ __('stu.dcd.actions.g_dc3.fi.dc3.label') }}',
                }]
            },
        ],
    },

    ct: {
        tx: '{{ __('stu.ct.name') }}',
        clr: '#834bba',
        sclr: '#1F9E4F',
        dt: [{
                id: 'g_ct1',
                name: '{{ __('stu.ct.actions.g_ct1.name') }}',
                fi: [{
                        i: 'ct1t',
                        t: 'text',
                        ic: 'ct',
                        r: 1,
                        ph: '{{ __('stu.ct.actions.g_ct1.fi.ct1t.placeholder') }}',
                        label: '{{ __('stu.ct.actions.g_ct1.fi.ct1t.label') }}',
                    },
                    {
                        i: 'ct1',
                        t: 'url',
                        ic: 'ct',
                        r: 1,
                        ph: '{{ __('stu.ct.actions.g_ct1.fi.ct1.placeholder') }}',
                        label: '{{ __('stu.ct.actions.g_ct1.fi.ct1.label') }}',
                    }
                ]
            },
            {
                id: 'g_ct2',
                name: '{{ __('stu.ct.actions.g_ct2.name') }}',
                fi: [{
                        i: 'ct2t',
                        t: 'text',
                        ic: 'ct',
                        r: 1,
                        ph: '{{ __('stu.ct.actions.g_ct2.fi.ct2t.placeholder') }}',
                        label: '{{ __('stu.ct.actions.g_ct2.fi.ct2t.label') }}',
                    },
                    {
                        i: 'ct2',
                        t: 'url',
                        ic: 'ct',
                        r: 1,
                        ph: '{{ __('stu.ct.actions.g_ct2.fi.ct2.placeholder') }}',
                        label: '{{ __('stu.ct.actions.g_ct2.fi.ct2.label') }}',
                    }
                ]
            },
            {
                id: 'g_ct3',
                name: '{{ __('stu.ct.actions.g_ct3.name') }}',
                fi: [{
                        i: 'ct3t',
                        t: 'text',
                        ic: 'ct',
                        r: 1,
                        ph: '{{ __('stu.ct.actions.g_ct3.fi.ct3t.placeholder') }}',
                        label: '{{ __('stu.ct.actions.g_ct3.fi.ct3t.label') }}',
                    },
                    {
                        i: 'ct3',
                        t: 'url',
                        ic: 'ct',
                        r: 1,
                        ph: '{{ __('stu.ct.actions.g_ct3.fi.ct3.placeholder') }}',
                        label: '{{ __('stu.ct.actions.g_ct3.fi.ct3.label') }}',
                    }
                ]
            },
        ],
    },

    dest: {
        tx: '{{ __('stu.dest.name') }}',
        clr: '#00cd4d',
        sclr: '#008835',
        dt: [{
                id: 'g_lnk1',
                name: '{{ __('stu.dest.actions.g_lnk1.name') }}',
                fi: [{
                        i: 'lnk1t',
                        t: 'text',
                        ic: 'fileT',
                        a: 1,
                        ro: true,
                        ph: '{{ __('stu.dest.actions.g_lnk1.fi.lnk1t.placeholder') }}',
                        label: '{{ __('stu.dest.actions.g_lnk1.fi.lnk1t.label') }}',
                    },
                    {
                        i: 'lnk1',
                        t: 'url',
                        ic: 'fileL',
                        a: 1,
                        r: 1,
                        l: 1,
                        ro: true,
                        ph: '{{ __('stu.dest.actions.g_lnk1.fi.lnk1.placeholder') }}',
                        label: '{{ __('stu.dest.actions.g_lnk1.fi.lnk1.label') }}',
                    },
                ],
            },

            {
                id: 'g_lnk2',
                name: '{{ __('stu.dest.actions.g_lnk2.name') }}',
                fi: [{
                        i: 'lnk2t',
                        t: 'text',
                        ic: 'fileT',
                        ro: true,
                        ph: '{{ __('stu.dest.actions.g_lnk2.fi.lnk2t.placeholder') }}',
                        label: '{{ __('stu.dest.actions.g_lnk2.fi.lnk2t.label') }}',
                    },
                    {
                        i: 'lnk2',
                        t: 'url',
                        ic: 'fileL',
                        r: 1,
                        l: 1,
                        ro: true,
                        ph: '{{ __('stu.dest.actions.g_lnk2.fi.lnk2.placeholder') }}',
                        label: '{{ __('stu.dest.actions.g_lnk2.fi.lnk2.label') }}',
                    },
                ],
            },

            {
                id: 'g_lnk3',
                name: '{{ __('stu.dest.actions.g_lnk3.name') }}',
                fi: [{
                        i: 'lnk3t',
                        t: 'text',
                        ic: 'fileT',
                        ro: true,
                        ph: '{{ __('stu.dest.actions.g_lnk3.fi.lnk3t.placeholder') }}',
                        label: '{{ __('stu.dest.actions.g_lnk3.fi.lnk3t.label') }}',
                    },
                    {
                        i: 'lnk3',
                        t: 'url',
                        ic: 'fileL',
                        r: 1,
                        l: 1,
                        ro: true,
                        ph: '{{ __('stu.dest.actions.g_lnk3.fi.lnk3.placeholder') }}',
                        label: '{{ __('stu.dest.actions.g_lnk3.fi.lnk3.label') }}',
                    },
                ],
            },

            {
                id: 'g_lnk4',
                name: '{{ __('stu.dest.actions.g_lnk4.name') }}',
                fi: [{
                        i: 'lnk4t',
                        t: 'text',
                        ic: 'fileT',
                        ro: true,
                        ph: '{{ __('stu.dest.actions.g_lnk4.fi.lnk4t.placeholder') }}',
                        label: '{{ __('stu.dest.actions.g_lnk4.fi.lnk4t.label') }}',
                    },
                    {
                        i: 'lnk4',
                        t: 'url',
                        ic: 'fileL',
                        r: 1,
                        l: 1,
                        ro: true,
                        ph: '{{ __('stu.dest.actions.g_lnk4.fi.lnk4.placeholder') }}',
                        label: '{{ __('stu.dest.actions.g_lnk4.fi.lnk4.label') }}',
                    },
                ],
            },

            {
                id: 'g_lnk5',
                name: '{{ __('stu.dest.actions.g_lnk5.name') }}',
                fi: [{
                        i: 'lnk5t',
                        t: 'text',
                        ic: 'fileT',
                        ro: true,
                        ph: '{{ __('stu.dest.actions.g_lnk5.fi.lnk5t.placeholder') }}',
                        label: '{{ __('stu.dest.actions.g_lnk5.fi.lnk5t.label') }}',
                    },
                    {
                        i: 'lnk5',
                        t: 'url',
                        ic: 'fileL',
                        r: 1,
                        l: 1,
                        ro: true,
                        ph: '{{ __('stu.dest.actions.g_lnk5.fi.lnk5.placeholder') }}',
                        label: '{{ __('stu.dest.actions.g_lnk5.fi.lnk5.label') }}',
                    },
                ],
            },
        ],
    },

    oth: {
        tx: '{{ __('stu.adv.name') }}',
        clr: '#3300cc',
        sclr: '#9f0000',
        dt: [{
                id: 'g_pwd',
                name: '{{ __('stu.adv.actions.g_pwd.name') }}',
                fi: [{
                    i: 'pwd',
                    t: 'text',
                    ic: 'pass',
                    r: 1,
                    ph: '{{ __('stu.adv.actions.g_pwd.fi.pwd.placeholder') }}',
                    label: '{{ __('stu.adv.actions.g_pwd.fi.pwd.label') }}',
                    attr: [{
                        minlength: 1
                    }, {
                        maxlength: 8
                    }]
                }],
            },
            {
                id: 'g_not',
                name: '{{ __('stu.adv.actions.g_not.name') }}',
                fi: [{
                    i: 'note',
                    t: 'text',
                    ic: 'note',
                    r: 1,
                    ph: '{{ __('stu.adv.actions.g_not.fi.note.placeholder') }}',
                    label: '{{ __('stu.adv.actions.g_not.fi.note.label') }}',
                }]
            },
            {
                id: 'g_sty',
                name: '{{ __('stu.adv.actions.g_sty.name') }}',
                fi: [{
                    i: 'sty',
                    t: 'select',
                    ic: 'style',
                    r: 1,
                    label: '{{ __('stu.adv.actions.g_sty.fi.sty.label') }}',
                    opts: [
                        ['{{ __('stu.adv.actions.g_sty.fi.sty.options')[0]['value'] }}', '{{ __('stu.adv.actions.g_sty.fi.sty.options')[0]['label'] }}'],
                        ['{{ __('stu.adv.actions.g_sty.fi.sty.options')[1]['value'] }}', '{{ __('stu.adv.actions.g_sty.fi.sty.options')[1]['label'] }}'],
                    ]
                }]
            },
            {
                id: 'g_exp',
                name: '{{ __('stu.adv.actions.g_exp.name') }}',
                fi: [{
                    i: 'exp',
                    t: 'datetime-local',
                    ic: 'exp',
                    r: 1,
                    label: '{{ __('stu.adv.actions.g_exp.fi.exp.placeholder') }}',
                    label: '{{ __('stu.adv.actions.g_exp.fi.exp.label') }}',
                    attr: [{
                        min: new Date().toISOString().slice(0, 16)
                    }]
                }],
            },
            {
                id: 'g_thmb',
                name: '{{ __('stu.adv.actions.g_thmb.name') }}',
                fi: [
                    // { i: 'image', t: 'file', ic: 'thumb', ndf: 1, attr: [{ accept: 'image/*' }] },
                    {
                        i: 'thmb',
                        t: 'url',
                        ic: 'thumb',
                        r: 1,
                        ph: '{{ __('stu.adv.actions.g_thmb.fi.thmb.placeholder') }}',
                        label: '{{ __('stu.adv.actions.g_thmb.fi.thmb.label') }}',
                        ndf: 1,
                        img: 1
                    },
                ],
            },
        ],
    },
};
</script>
