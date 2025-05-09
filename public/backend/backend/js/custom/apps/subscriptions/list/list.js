"use strict";
var KTSubscriptionsList = function() {
    var t, e, n, o, c,
        l = () => {
            const checkBoxs = t.querySelectorAll('[type="checkbox"]');
            n = document.querySelector('[data-kt-subscription-table-toolbar="base"]'), o = document.querySelector('[data-kt-subscription-table-toolbar="selected"]'), c = document.querySelector('[data-qk-short-api-action="selected_count"]');
            const turn_on_selected = document.querySelector('[data-qk-short-api-action="turn_on_selected"]');
            const turn_off_selected = document.querySelector('[data-qk-short-api-action="turn_off_selected"]');
            const reset_selected = document.querySelector('[data-qk-short-api-action="reset_selected"]');

            checkBoxs.forEach((checkbox => {
                checkbox.addEventListener("click", (function() {
                    setTimeout((function() {
                        i()
                    }), 50)
                }))
            }));
            turn_on_selected.addEventListener("click", (function() {
                Swal.fire({
                    text: "Bạn có chắc chắn muốn bật tăt cả API đã chọn không??",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Vâng, chắc chắn!",
                    cancelButtonText: "Không, huỷ",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then((result) => {
                    if (result.isConfirmed) {

                        let idList = [];
                        const tbodyCheckboxs = t.querySelectorAll('tbody [type="checkbox"]');
                        tbodyCheckboxs.forEach((t => {
                            if (t.checked) {
                                idList.push(t.value);
                            }
                        }));
                        if (idList.length) {
                            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                            $.ajax({
                                url: '/member/axaj/short-api/trun-on',
                                method: 'POST',
                                data: {
                                    'data': idList,
                                    '_token': csrfToken

                                },
                                success: function(response) {
                                    Swal.fire({
                                        text: "Thao tác thành công!",
                                        icon: "success",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, hiểu rồi!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary"
                                        }
                                    }).then((function() {
                                        tbodyCheckboxs.forEach((t => {
                                            if(t.checked) {
                                                let row = t.closest("tbody tr");
                                                
                                                row.querySelectorAll('td')[2].innerHTML = '<span class="badge badge-light-success">Đang bật</span>';
                                                t.checked = false;
                                            }
                                        }));
                                        t.querySelectorAll('[type="checkbox"]')[0].checked = !1
                                    })).then((function() {
                                        i()
                                    }));
                                },
                                error: function(xhr, status, error) {
                                    // Xử lý lỗi
                                    Swal.fire({
                                        text: "An error occurred while deleting " + o + ".",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary"
                                        }
                                    });
                                }
                            })
                        }
                    }
                })
            }))

            turn_off_selected.addEventListener("click", (function() {
                Swal.fire({
                    text: "Bạn có chắc chắn muốn tắt tất cả API đã chọn không??",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Vâng, chắc chắn!",
                    cancelButtonText: "Không, huỷ",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then((result) => {
                    if (result.isConfirmed) {

                        let idList = [];
                        const tbodyCheckboxs = t.querySelectorAll('tbody [type="checkbox"]');
                        tbodyCheckboxs.forEach((t => {
                            if (t.checked) {
                                idList.push(t.value);
                            }
                        }));
                        if (idList.length) {
                            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                            $.ajax({
                                url: '/member/axaj/short-api/trun-off',
                                method: 'POST',
                                data: {
                                    'data': idList,
                                    '_token': csrfToken

                                },
                                success: function(response) {
                                    Swal.fire({
                                        text: "Thao tác thành công!",
                                        icon: "success",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, hiểu rồi!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary"
                                        }
                                    }).then((function() {
                                        tbodyCheckboxs.forEach((t => {
                                            if(t.checked) {
                                                let row = t.closest("tbody tr");
                                                
                                                row.querySelectorAll('td')[2].innerHTML = '<span class="badge badge-light-danger">Đang tắt</span>';
                                                t.checked = false;
                                            }
                                        }));
                                        t.querySelectorAll('[type="checkbox"]')[0].checked = !1
                                    })).then((function() {
                                        i()
                                    }));
                                },
                                error: function(xhr, status, error) {
                                    // Xử lý lỗi
                                    Swal.fire({
                                        text: "An error occurred while deleting " + o + ".",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary"
                                        }
                                    });
                                }
                            })
                        }
                    }

                })
            }))

            reset_selected.addEventListener("click", (function() {
                Swal.fire({
                    text: "Bạn có chắc chắn muốn đặt lại tất cả API đã chọn không??",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Vâng, chắc chắn!",
                    cancelButtonText: "Không, huỷ",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then((result) => {
                    if (result.isConfirmed) {

                        let idList = [];
                        const tbodyCheckboxs = t.querySelectorAll('tbody [type="checkbox"]');
                        tbodyCheckboxs.forEach((t => {
                            if (t.checked) {
                                idList.push(t.value);
                            }
                        }));
                        if (idList.length) {
                            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                            $.ajax({
                                url: '/member/axaj/short-api/reset',
                                method: 'POST',
                                data: {
                                    'data': idList,
                                    '_token': csrfToken

                                },
                                success: function(response) {
                                    Swal.fire({
                                        text: "Thao tác thành công!",
                                        icon: "success",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, hiểu rồi!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary"
                                        }
                                    }).then((function() {
                                        tbodyCheckboxs.forEach((t => {
                                            if(t.checked) {
                                                let row = t.closest("tbody tr");
                                                
                                                row.querySelectorAll('td')[2].innerHTML = '<span class="badge badge-light-danger">Đang tắt</span>';
                                                t.checked = false;
                                            }
                                        }));
                                        t.querySelectorAll('[type="checkbox"]')[0].checked = !1
                                    })).then((function() {
                                        i()
                                    }));
                                },
                                error: function(xhr, status, error) {
                                    // Xử lý lỗi
                                    Swal.fire({
                                        text: "An error occurred while deleting " + o + ".",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary"
                                        }
                                    });
                                }
                            })
                        }
                    }

                })
            }))
        };
    const i = () => {
        const e = t.querySelectorAll('tbody [type="checkbox"]');
        let r = !1,
            l = 0;
        e.forEach((t => {
            t.checked && (r = !0, l++)
        })), r ? (c.innerHTML = l, n.classList.add("d-none"), o.classList.remove("d-none")) : (n.classList.remove("d-none"), o.classList.add("d-none"))
    };
    return {
        init: function() {
            (t = document.getElementById("kt_subscriptions_table")) && (t.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    n = moment(e[5].innerHTML, "DD MMM YYYY, LT").format();
                e[5].setAttribute("data-order", n)
            })), (e = $(t).DataTable({
                info: true,
                order: [],
                pageLength: 10,
                lengthChange: !1,
                columnDefs: [{
                    orderable: !1,
                    targets: 0
                }, {
                    orderable: !1,
                    targets: 7
                }]
            })).on("draw", (function() {
                l(), i()
            })), l(), document.querySelector('[data-kt-subscription-table-filter="search"]').addEventListener("keyup", (function(t) {
                e.search(t.target.value).draw()
            })),  function() {
                const t = document.querySelector('[data-kt-subscription-table-filter="form"]'),
                    n = t.querySelector('[data-kt-subscription-table-filter="filter"]'),
                    status = t.querySelector('[data-kt-subscription-table-filter="status"]'),
                    o = t.querySelector('[data-kt-subscription-table-filter="reset"]'),
                    c = t.querySelectorAll("select");
                n.addEventListener("click", (function() {
                    let statusValue = status.value || "";

                    // Lọc theo giá trị của data-status trong cột data-dt-column="2"
                    e.column(2).search(statusValue).draw();
                })), o.addEventListener("click", (function() {
                    c.forEach(((t, e) => {
                        $(t).val(null).trigger("change")
                    })), e.search("").draw()
                }))
            }())
        }
    }
}();
KTUtil.onDOMContentLoaded((function() {
    KTSubscriptionsList.init()
}));