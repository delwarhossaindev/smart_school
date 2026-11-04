<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application routes
|--------------------------------------------------------------------------
|
| One Route::ci() per controller. Order matters: the custom routes come first and
| shadow the controller routes, exactly as they did in CodeIgniter.
|
*/

Route::any('/', \App\Http\Controllers\LegacyHome::class);

// Custom routes
Route::ciCustom('branch/(:any)', \App\Http\Controllers\Web\Web::class, 'branch', ['$1'], 'web', 'web');
Route::ciCustom('(:any)/about', \App\Http\Controllers\Web\Web::class, 'about', [], 'web', 'web');
Route::ciCustom('(:any)', \App\Http\Controllers\Web\Web::class, 'index', ['$1'], 'web', 'web');
Route::ciCustom('(:any)/news', \App\Http\Controllers\Web\Web::class, 'news', [], 'web', 'web');
Route::ciCustom('(:any)/news-detail/(:num)', \App\Http\Controllers\Web\Web::class, 'news_detail', ['$1'], 'web', 'web');
Route::ciCustom('(:any)/notice', \App\Http\Controllers\Web\Web::class, 'notice', [], 'web', 'web');
Route::ciCustom('(:any)/notice-detail/(:num)', \App\Http\Controllers\Web\Web::class, 'notice_detail', ['$1'], 'web', 'web');
Route::ciCustom('(:any)/holiday', \App\Http\Controllers\Web\Web::class, 'holiday', [], 'web', 'web');
Route::ciCustom('(:any)/holiday-detail/(:num)', \App\Http\Controllers\Web\Web::class, 'holiday_detail', ['$1'], 'web', 'web');
Route::ciCustom('(:any)/events', \App\Http\Controllers\Web\Web::class, 'events', [], 'web', 'web');
Route::ciCustom('(:any)/event-detail/(:num)', \App\Http\Controllers\Web\Web::class, 'event_detail', ['$1'], 'web', 'web');
Route::ciCustom('(:any)/galleries', \App\Http\Controllers\Web\Web::class, 'galleries', [], 'web', 'web');
Route::ciCustom('(:any)/gallery-image/(:num)', \App\Http\Controllers\Web\Web::class, 'gallery_image', ['$1'], 'web', 'web');
Route::ciCustom('(:any)/teachers', \App\Http\Controllers\Web\Web::class, 'teachers', [], 'web', 'web');
Route::ciCustom('(:any)/staff', \App\Http\Controllers\Web\Web::class, 'staff', [], 'web', 'web');
Route::ciCustom('(:any)/contact', \App\Http\Controllers\Web\Web::class, 'contact', [], 'web', 'web');
Route::ciCustom('(:any)/admission-online', \App\Http\Controllers\Web\Web::class, 'admission_online', [], 'web', 'web');
Route::ciCustom('(:any)/admission-form', \App\Http\Controllers\Web\Web::class, 'admission_form', [], 'web', 'web');
Route::ciCustom('(:any)/page/(:any)', \App\Http\Controllers\Web\Web::class, 'page', ['$1'], 'web', 'web');
Route::ciCustom('auth/login', \App\Http\Controllers\Welcome::class, 'index', [], NULL, 'welcome');
Route::ciCustom('auth/forgot', \App\Http\Controllers\Auth::class, 'forgot', [], NULL, 'auth');
Route::ciCustom('auth/reset/(:any)', \App\Http\Controllers\Auth::class, 'reset', ['$1'], NULL, 'auth');

// Application controllers
Route::ci('ajax', \App\Http\Controllers\Ajax::class, ['index', 'get_user_by_role', 'get_tag_by_role', 'update_user_status', 'get_student_by_class', 'get_section_by_class', 'get_student_by_section', 'get_subject_by_class', 'get_assignment_by_subject', 'get_guardian_by_id', 'get_room_by_hostel', 'get_user_list_by_type', 'get_designation_by_school', 'get_salary_grade_by_school', 'get_teacher_by_school', 'get_employee_by_school', 'get_guardian_by_school', 'get_discount_by_school', 'get_student_type_by_school', 'get_class_by_school', 'get_exam_by_school', 'get_gallery_by_school', 'get_leave_type_by_school', 'get_visitor_purpose_by_school', 'get_complain_type_by_school', 'get_user_single_payment', 'get_school_info_by_id', 'get_sms_gateways', 'get_email_template_by_role', 'get_email_template_by_id', 'get_sms_template_by_role', 'update_student_status_type'], null, 'ajax');
Route::ci('auth', \App\Http\Controllers\Auth::class, ['index', 'logout', 'forgot', 'forgotpass', 'reset', 'resetpass'], null, 'auth');
Route::ci('dashboard', \App\Http\Controllers\Dashboard::class, ['index', 'get_search'], null, 'dashboard');
Route::ci('profile', \App\Http\Controllers\Profile::class, ['index', 'update', 'password'], null, 'profile');
Route::ci('theme', \App\Http\Controllers\Theme::class, ['index', 'activate'], null, 'theme');
Route::ci('usercomplain', \App\Http\Controllers\Usercomplain::class, ['index', 'add', 'edit', 'get_single_complain', 'delete'], null, 'usercomplain');
Route::ci('userleave', \App\Http\Controllers\Userleave::class, ['index', 'add', 'edit', 'get_single_leave_application', 'leave_to', 'attachment', 'delete'], null, 'userleave');
Route::ci('verify', \App\Http\Controllers\Verify::class, ['index'], null, 'verify');
Route::ci('welcome', \App\Http\Controllers\Welcome::class, ['index'], null, 'welcome');

// Academic module
Route::ci('academic/classes', \App\Http\Controllers\Academic\Classes::class, ['index', 'add', 'edit', 'name', 'delete'], 'academic', 'classes');
Route::ci('academic/liveclass', \App\Http\Controllers\Academic\Liveclass::class, ['index', 'add', 'edit', 'get_single_live_class', 'teacher_id', 'sms_gateway', 'delete', 'start'], 'academic', 'liveclass');
Route::ci('academic/material', \App\Http\Controllers\Academic\Material::class, ['index', 'add', 'edit', 'view', 'get_single_material', 'material', 'delete'], 'academic', 'material');
Route::ci('academic/promotion', \App\Http\Controllers\Academic\Promotion::class, ['index', 'add'], 'academic', 'promotion');
Route::ci('academic/routine', \App\Http\Controllers\Academic\Routine::class, ['index', 'add', 'edit', 'subject_id', 'teacher_id', 'room_no', 'delete'], 'academic', 'routine');
Route::ci('academic/section', \App\Http\Controllers\Academic\Section::class, ['index', 'add', 'edit', 'name', 'delete'], 'academic', 'section');
Route::ci('academic/subject', \App\Http\Controllers\Academic\Subject::class, ['index', 'add', 'edit', 'view', 'get_single_subject', 'name', 'delete'], 'academic', 'subject');
Route::ci('academic/syllabus', \App\Http\Controllers\Academic\Syllabus::class, ['index', 'add', 'edit', 'get_single_syllabus', 'syllabus', 'delete'], 'academic', 'syllabus');

// Accounting module
Route::ci('accounting/discount', \App\Http\Controllers\Accounting\Discount::class, ['index', 'add', 'edit', 'title', 'delete'], 'accounting', 'discount');
Route::ci('accounting/duefeeemail', \App\Http\Controllers\Accounting\Duefeeemail::class, ['index', 'add', 'view', 'get_single_email', 'delete'], 'accounting', 'duefeeemail');
Route::ci('accounting/duefeesms', \App\Http\Controllers\Accounting\Duefeesms::class, ['index', 'add', 'get_single_sms', 'sms_gateway', 'delete'], 'accounting', 'duefeesms');
Route::ci('accounting/expenditure', \App\Http\Controllers\Accounting\Expenditure::class, ['index', 'add', 'edit', 'view', 'get_single_expenditure', 'delete', 'get_expenditure_head_by_school', 'get_payment_method_by_school'], 'accounting', 'expenditure');
Route::ci('accounting/exphead', \App\Http\Controllers\Accounting\Exphead::class, ['index', 'add', 'edit', 'title', 'delete'], 'accounting', 'exphead');
Route::ci('accounting/feetype', \App\Http\Controllers\Accounting\Feetype::class, ['index', 'add', 'edit', 'get_single_feetype', 'title', 'delete', 'get_fee_head_by_school'], 'accounting', 'feetype');
Route::ci('accounting/gateway', \App\Http\Controllers\Accounting\Gateway::class, ['paypal_notify', 'dbbl'], 'accounting', 'gateway');
Route::ci('accounting/income', \App\Http\Controllers\Accounting\Income::class, ['index', 'add', 'edit', 'view', 'get_single_income', 'delete', 'get_income_head_by_school', 'get_payment_method_by_school'], 'accounting', 'income');
Route::ci('accounting/incomehead', \App\Http\Controllers\Accounting\Incomehead::class, ['index', 'add', 'edit', 'title', 'delete'], 'accounting', 'incomehead');
Route::ci('accounting/invoice', \App\Http\Controllers\Accounting\Invoice::class, ['index', 'view', 'get_single_invoice', 'due', 'add', 'bulk', 'edit', 'delete', 'get_single_fee_type_by_school', 'get_single_fee_amount', 'get_bulk_fee_type_by_school', 'get_bulk_fee_amount', 'get_student_by_class', 'get_fee_type_by_school'], 'accounting', 'invoice');
Route::ci('accounting/payment', \App\Http\Controllers\Accounting\Payment::class, ['index', 'paid', 'amount', 'payment_method', 'dbbl', 'dbbl_failed', 'dbbl_success', 'pay_u_money', 'payumoney_failed', 'payumoney_success', 'paypal', 'paypal_cancel', 'paypal_success', 'cc_avenue', 'cc_avenue_success', 'cc_avenue_cancel', 'pay_tm', 'pay_tm_success', 'pay_tm_cancel', 'pay_stack', 'pay_stack_cancel', 'pay_stack_success'], 'accounting', 'payment');
Route::ci('accounting/receipt', \App\Http\Controllers\Accounting\Receipt::class, ['index', 'duereceipt', 'get_single_due_receipt', 'paidreceipt', 'get_single_paid_receipt'], 'accounting', 'receipt');

// Administrator module
Route::ci('administrator/activitylog', \App\Http\Controllers\Administrator\Activitylog::class, ['index', 'delete', 'multidelete'], 'administrator', 'activitylog');
Route::ci('administrator/backup', \App\Http\Controllers\Administrator\Backup::class, ['index'], 'administrator', 'backup');
Route::ci('administrator/emailsetting', \App\Http\Controllers\Administrator\Emailsetting::class, ['index', 'add', 'edit', 'get_single_email_setting', 'branch_id', 'delete'], 'administrator', 'emailsetting');
Route::ci('administrator/emailtemplate', \App\Http\Controllers\Administrator\Emailtemplate::class, ['index', 'add', 'edit', 'title', 'delete'], 'administrator', 'emailtemplate');
Route::ci('administrator/feedback', \App\Http\Controllers\Administrator\Feedback::class, ['index', 'add', 'edit', 'get_single_feedback', 'delete', 'activate', 'deactivate'], 'administrator', 'feedback');
Route::ci('administrator/openinghour', \App\Http\Controllers\Administrator\Openinghour::class, ['index', 'add', 'edit', 'get_single_opening_hour', 'branch_id', 'delete'], 'administrator', 'openinghour');
Route::ci('administrator/password', \App\Http\Controllers\Administrator\Password::class, ['index'], 'administrator', 'password');
Route::ci('administrator/payment', \App\Http\Controllers\Administrator\Payment::class, ['index', 'add', 'edit', 'view', 'get_single_payment', 'branch_id', 'delete'], 'administrator', 'payment');
Route::ci('administrator/permission', \App\Http\Controllers\Administrator\Permission::class, ['index'], 'administrator', 'permission');
Route::ci('administrator/role', \App\Http\Controllers\Administrator\Role::class, ['index', 'add', 'edit', 'name', 'delete'], 'administrator', 'role');
Route::ci('administrator/school', \App\Http\Controllers\Administrator\School::class, ['index', 'add', 'edit', 'get_single_school', 'branch_name', 'branch_url', 'logo', 'frontend_logo', 'delete'], 'administrator', 'school');
Route::ci('administrator/setting', \App\Http\Controllers\Administrator\Setting::class, ['index', 'add', 'edit', 'logo', 'favicon_icon'], 'administrator', 'setting');
Route::ci('administrator/sms', \App\Http\Controllers\Administrator\Sms::class, ['index', 'add', 'edit', 'view', 'get_single_sms', 'branch_id', 'delete'], 'administrator', 'sms');
Route::ci('administrator/smstemplate', \App\Http\Controllers\Administrator\Smstemplate::class, ['index', 'add', 'edit', 'title', 'delete'], 'administrator', 'smstemplate');
Route::ci('administrator/superadmin', \App\Http\Controllers\Administrator\Superadmin::class, ['index', 'add', 'edit', 'get_single_super_admin', 'username', 'resume', 'photo', 'delete'], 'administrator', 'superadmin');
Route::ci('administrator/user', \App\Http\Controllers\Administrator\User::class, ['index'], 'administrator', 'user');
Route::ci('administrator/usercredential', \App\Http\Controllers\Administrator\Usercredential::class, ['index'], 'administrator', 'usercredential');
Route::ci('administrator/username', \App\Http\Controllers\Administrator\Username::class, ['index'], 'administrator', 'username');
Route::ci('administrator/year', \App\Http\Controllers\Administrator\Year::class, ['index', 'add', 'edit', 'session_year', 'delete', 'activate'], 'administrator', 'year');

// Announcement module
Route::ci('announcement/holiday', \App\Http\Controllers\Announcement\Holiday::class, ['index', 'add', 'edit', 'view', 'get_single_holiday', 'title', 'date_to', 'delete'], 'announcement', 'holiday');
Route::ci('announcement/news', \App\Http\Controllers\Announcement\News::class, ['index', 'add', 'edit', 'view', 'get_single_news', 'title', 'image', 'delete'], 'announcement', 'news');
Route::ci('announcement/notice', \App\Http\Controllers\Announcement\Notice::class, ['index', 'add', 'edit', 'view', 'get_single_notice', 'title', 'delete'], 'announcement', 'notice');

// Assignment module
Route::ci('assignment/assignment', \App\Http\Controllers\Assignment\Assignment::class, ['index', 'add', 'edit', 'view', 'get_single_assignment', 'assignment', 'delete', 'get_assignment_by_section'], 'assignment', 'assignment');
Route::ci('assignment/submission', \App\Http\Controllers\Assignment\Submission::class, ['index', 'add', 'edit', 'get_single_submission', 'submission', 'delete'], 'assignment', 'submission');
Route::ci('assignment', \App\Http\Controllers\Assignment\Assignment::class, ['index', 'add', 'edit', 'view', 'get_single_assignment', 'assignment', 'delete', 'get_assignment_by_section'], 'assignment', 'assignment');

// Attendance module
Route::ci('attendance/absentemail', \App\Http\Controllers\Attendance\Absentemail::class, ['index', 'add', 'view', 'get_single_email', 'delete'], 'attendance', 'absentemail');
Route::ci('attendance/absentsms', \App\Http\Controllers\Attendance\Absentsms::class, ['index', 'add', 'get_single_sms', 'sms_gateway', 'delete'], 'attendance', 'absentsms');
Route::ci('attendance/employee', \App\Http\Controllers\Attendance\Employee::class, ['index', 'update_single_attendance', 'update_all_attendance'], 'attendance', 'employee');
Route::ci('attendance/student', \App\Http\Controllers\Attendance\Student::class, ['index', 'guardian', 'update_single_attendance', 'update_all_attendance'], 'attendance', 'student');
Route::ci('attendance/teacher', \App\Http\Controllers\Attendance\Teacher::class, ['index', 'update_single_attendance', 'update_all_attendance'], 'attendance', 'teacher');

// Card module
Route::ci('card/admit', \App\Http\Controllers\Card\Admit::class, ['index'], 'card', 'admit');
Route::ci('card/admitsetting', \App\Http\Controllers\Card\Admitsetting::class, ['index', 'add', 'edit', 'get_single_admit_setting', 'branch_id', 'branch_logo', 'delete'], 'card', 'admitsetting');
Route::ci('card/card', \App\Http\Controllers\Card\Card::class, ['index'], 'card', 'card');
Route::ci('card/employee', \App\Http\Controllers\Card\Employee::class, ['index'], 'card', 'employee');
Route::ci('card/idsetting', \App\Http\Controllers\Card\Idsetting::class, ['index', 'add', 'edit', 'get_single_id_setting', 'branch_id', 'branch_logo', 'delete'], 'card', 'idsetting');
Route::ci('card/schooladmitsetting', \App\Http\Controllers\Card\Schooladmitsetting::class, ['index', 'add', 'edit', 'get_single_admit_setting', 'branch_id'], 'card', 'schooladmitsetting');
Route::ci('card/schoolidsetting', \App\Http\Controllers\Card\Schoolidsetting::class, ['index', 'add', 'edit', 'get_single_id_setting', 'branch_id'], 'card', 'schoolidsetting');
Route::ci('card/student', \App\Http\Controllers\Card\Student::class, ['index'], 'card', 'student');
Route::ci('card/teacher', \App\Http\Controllers\Card\Teacher::class, ['index'], 'card', 'teacher');
Route::ci('card', \App\Http\Controllers\Card\Card::class, ['index'], 'card', 'card');

// Certificate module
Route::ci('certificate/certificate', \App\Http\Controllers\Certificate\Certificate::class, ['index', 'generate'], 'certificate', 'certificate');
Route::ci('certificate/type', \App\Http\Controllers\Certificate\Type::class, ['index', 'add', 'edit', 'view', 'name', 'background', 'delete'], 'certificate', 'type');
Route::ci('certificate', \App\Http\Controllers\Certificate\Certificate::class, ['index', 'generate'], 'certificate', 'certificate');

// Complain module
Route::ci('complain/complain', \App\Http\Controllers\Complain\Complain::class, ['index', 'add', 'edit', 'get_single_complain', 'delete'], 'complain', 'complain');
Route::ci('complain/type', \App\Http\Controllers\Complain\Type::class, ['index', 'add', 'edit', 'type', 'delete'], 'complain', 'type');
Route::ci('complain', \App\Http\Controllers\Complain\Complain::class, ['index', 'add', 'edit', 'get_single_complain', 'delete'], 'complain', 'complain');

// Event module
Route::ci('event/event', \App\Http\Controllers\Event\Event::class, ['index', 'add', 'edit', 'view', 'get_single_event', 'title', 'event_to', 'image', 'delete'], 'event', 'event');
Route::ci('event', \App\Http\Controllers\Event\Event::class, ['index', 'add', 'edit', 'view', 'get_single_event', 'title', 'event_to', 'image', 'delete'], 'event', 'event');

// Exam module
Route::ci('exam/attendance', \App\Http\Controllers\Exam\Attendance::class, ['index', 'update_single', 'update_all'], 'exam', 'attendance');
Route::ci('exam/exam', \App\Http\Controllers\Exam\Exam::class, ['index', 'add', 'edit', 'view', 'title', 'delete'], 'exam', 'exam');
Route::ci('exam/examresult', \App\Http\Controllers\Exam\Examresult::class, ['index', 'add'], 'exam', 'examresult');
Route::ci('exam/finalresult', \App\Http\Controllers\Exam\Finalresult::class, ['index', 'add'], 'exam', 'finalresult');
Route::ci('exam/grade', \App\Http\Controllers\Exam\Grade::class, ['index', 'add', 'edit', 'view', 'name', 'point', 'delete'], 'exam', 'grade');
Route::ci('exam/mail', \App\Http\Controllers\Exam\Mail::class, ['index', 'view', 'get_single_email', 'send', 'delete'], 'exam', 'mail');
Route::ci('exam/mark', \App\Http\Controllers\Exam\Mark::class, ['index', 'add'], 'exam', 'mark');
Route::ci('exam/marksheet', \App\Http\Controllers\Exam\Marksheet::class, ['index'], 'exam', 'marksheet');
Route::ci('exam/meritlist', \App\Http\Controllers\Exam\Meritlist::class, ['index'], 'exam', 'meritlist');
Route::ci('exam/result', \App\Http\Controllers\Exam\Result::class, ['index', 'add'], 'exam', 'result');
Route::ci('exam/resultcard', \App\Http\Controllers\Exam\Resultcard::class, ['index', 'all'], 'exam', 'resultcard');
Route::ci('exam/resultemail', \App\Http\Controllers\Exam\Resultemail::class, ['index', 'add', 'view', 'get_single_email', 'delete'], 'exam', 'resultemail');
Route::ci('exam/resultsms', \App\Http\Controllers\Exam\Resultsms::class, ['index', 'add', 'get_single_sms', 'sms_gateway', 'delete'], 'exam', 'resultsms');
Route::ci('exam/schedule', \App\Http\Controllers\Exam\Schedule::class, ['index', 'add', 'edit', 'view', 'get_single_schedule', 'subject_id', 'room_no', 'delete'], 'exam', 'schedule');
Route::ci('exam/suggestion', \App\Http\Controllers\Exam\Suggestion::class, ['index', 'add', 'edit', 'view', 'get_single_suggestion', 'subject_id', 'suggestion', 'delete'], 'exam', 'suggestion');
Route::ci('exam/testing', \App\Http\Controllers\Exam\Testing::class, ['index'], 'exam', 'testing');
Route::ci('exam/text', \App\Http\Controllers\Exam\Text::class, ['index', 'send', 'get_single_sms', 'sms_gateway', 'delete'], 'exam', 'text');
Route::ci('exam', \App\Http\Controllers\Exam\Exam::class, ['index', 'add', 'edit', 'view', 'title', 'delete'], 'exam', 'exam');

// Frontend module
Route::ci('frontend/about', \App\Http\Controllers\Frontend\About::class, ['index', 'edit', 'get_single_school', 'about_image'], 'frontend', 'about');
Route::ci('frontend/frontend', \App\Http\Controllers\Frontend\Frontend::class, ['index', 'add', 'edit', 'view', 'get_single_frontend', 'page_title', 'page_image', 'delete'], 'frontend', 'frontend');
Route::ci('frontend/slider', \App\Http\Controllers\Frontend\Slider::class, ['index', 'add', 'edit', 'get_single_slider', 'image', 'delete'], 'frontend', 'slider');
Route::ci('frontend', \App\Http\Controllers\Frontend\Frontend::class, ['index', 'add', 'edit', 'view', 'get_single_frontend', 'page_title', 'page_image', 'delete'], 'frontend', 'frontend');

// Frontoffice module
Route::ci('frontoffice/calllog', \App\Http\Controllers\Frontoffice\Calllog::class, ['index', 'add', 'edit', 'get_single_calllog', 'delete'], 'frontoffice', 'calllog');
Route::ci('frontoffice/dispatch', \App\Http\Controllers\Frontoffice\Dispatch::class, ['index', 'add', 'edit', 'get_single_dispatch', 'attachment', 'delete'], 'frontoffice', 'dispatch');
Route::ci('frontoffice/purpose', \App\Http\Controllers\Frontoffice\Purpose::class, ['index', 'add', 'edit', 'purpose', 'delete'], 'frontoffice', 'purpose');
Route::ci('frontoffice/receive', \App\Http\Controllers\Frontoffice\Receive::class, ['index', 'add', 'edit', 'get_single_receive', 'attachment', 'delete'], 'frontoffice', 'receive');
Route::ci('frontoffice/visitor', \App\Http\Controllers\Frontoffice\Visitor::class, ['index', 'add', 'edit', 'view', 'get_single_visitor', 'delete', 'visitor_check_out'], 'frontoffice', 'visitor');

// Gallery module
Route::ci('gallery/gallery', \App\Http\Controllers\Gallery\Gallery::class, ['index', 'add', 'edit', 'view', 'title', 'delete'], 'gallery', 'gallery');
Route::ci('gallery/image', \App\Http\Controllers\Gallery\Image::class, ['index', 'add', 'edit', 'view', 'get_single_image', 'image', 'delete'], 'gallery', 'image');
Route::ci('gallery', \App\Http\Controllers\Gallery\Gallery::class, ['index', 'add', 'edit', 'view', 'title', 'delete'], 'gallery', 'gallery');

// Guardian module
Route::ci('guardian/feedback', \App\Http\Controllers\Guardian\Feedback::class, ['index', 'add', 'edit', 'get_single_feedback', 'delete'], 'guardian', 'feedback');
Route::ci('guardian/guardian', \App\Http\Controllers\Guardian\Guardian::class, ['index', 'add', 'edit', 'get_single_guardian', 'username', 'photo', 'delete', 'invoice', 'view'], 'guardian', 'guardian');
Route::ci('guardian', \App\Http\Controllers\Guardian\Guardian::class, ['index', 'add', 'edit', 'get_single_guardian', 'username', 'photo', 'delete', 'invoice', 'view'], 'guardian', 'guardian');

// Hostel module
Route::ci('hostel/hostel', \App\Http\Controllers\Hostel\Hostel::class, ['index', 'add', 'edit', 'view', 'get_single_hostel', 'name', 'delete'], 'hostel', 'hostel');
Route::ci('hostel/member', \App\Http\Controllers\Hostel\Member::class, ['index', 'add', 'delete', 'add_to_hostel'], 'hostel', 'member');
Route::ci('hostel/room', \App\Http\Controllers\Hostel\Room::class, ['index', 'add', 'edit', 'view', 'get_single_room', 'room_no', 'delete', 'get_hostel_by_school'], 'hostel', 'room');
Route::ci('hostel', \App\Http\Controllers\Hostel\Hostel::class, ['index', 'add', 'edit', 'view', 'get_single_hostel', 'name', 'delete'], 'hostel', 'hostel');

// Hrm module
Route::ci('hrm/designation', \App\Http\Controllers\Hrm\Designation::class, ['index', 'add', 'edit', 'name', 'delete'], 'hrm', 'designation');
Route::ci('hrm/employee', \App\Http\Controllers\Hrm\Employee::class, ['index', 'add', 'edit', 'get_single_employee', 'username', 'resume', 'photo', 'delete', 'update_display_order', 'view'], 'hrm', 'employee');

// Language module
Route::ci('language/language', \App\Http\Controllers\Language\Language::class, ['index', 'add', 'edit', 'activate', 'delete', 'label', 'update'], 'language', 'language');
Route::ci('language', \App\Http\Controllers\Language\Language::class, ['index', 'add', 'edit', 'activate', 'delete', 'label', 'update'], 'language', 'language');

// Leave module
Route::ci('leave/application', \App\Http\Controllers\Leave\Application::class, ['index', 'add', 'edit', 'get_single_application', 'leave_to', 'attachment', 'delete', 'waiting'], 'leave', 'application');
Route::ci('leave/approve', \App\Http\Controllers\Leave\Approve::class, ['index', 'update', 'get_single_application', 'leave_to', 'delete', 'waiting'], 'leave', 'approve');
Route::ci('leave/decline', \App\Http\Controllers\Leave\Decline::class, ['index', 'update', 'get_single_application', 'delete', 'waiting'], 'leave', 'decline');
Route::ci('leave/leave', \App\Http\Controllers\Leave\Leave::class, ['index'], 'leave', 'leave');
Route::ci('leave/type', \App\Http\Controllers\Leave\Type::class, ['index', 'add', 'edit', 'type', 'delete'], 'leave', 'type');
Route::ci('leave/waiting', \App\Http\Controllers\Leave\Waiting::class, ['index', 'get_single_application', 'delete'], 'leave', 'waiting');
Route::ci('leave', \App\Http\Controllers\Leave\Leave::class, ['index'], 'leave', 'leave');

// Library module
Route::ci('library/book', \App\Http\Controllers\Library\Book::class, ['index', 'add', 'edit', 'get_single_book', 'cover', 'delete'], 'library', 'book');
Route::ci('library/ebook', \App\Http\Controllers\Library\Ebook::class, ['index', 'add', 'edit', 'get_single_ebook', 'get_single_read_ebook', 'cover_image', 'file_name', 'delete'], 'library', 'ebook');
Route::ci('library/issue', \App\Http\Controllers\Library\Issue::class, ['index', 'add', 'get_book_by_id', 'return_book_by_id', 'get_book_by_school', 'get_library_member_by_class'], 'library', 'issue');
Route::ci('library/member', \App\Http\Controllers\Library\Member::class, ['index', 'add', 'delete', 'add_to_library'], 'library', 'member');

// Message module
Route::ci('message/mail', \App\Http\Controllers\Message\Mail::class, ['index', 'add', 'get_single_email', 'delete'], 'message', 'mail');
Route::ci('message/message', \App\Http\Controllers\Message\Message::class, ['index', 'inbox', 'sent', 'draft', 'trash', 'compose', 'view', 'reply', 'delete', 'set_fvourite_status', 'set_trash_status', 'set_delete_status'], 'message', 'message');
Route::ci('message/text', \App\Http\Controllers\Message\Text::class, ['index', 'add', 'get_single_sms', 'sms_gateway', 'delete'], 'message', 'text');
Route::ci('message', \App\Http\Controllers\Message\Message::class, ['index', 'inbox', 'sent', 'draft', 'trash', 'compose', 'view', 'reply', 'delete', 'set_fvourite_status', 'set_trash_status', 'set_delete_status'], 'message', 'message');

// Payroll module
Route::ci('payroll/grade', \App\Http\Controllers\Payroll\Grade::class, ['index', 'add', 'edit', 'get_single_grade', 'grade_name', 'delete'], 'payroll', 'grade');
Route::ci('payroll/history', \App\Http\Controllers\Payroll\History::class, ['index', 'get_single_payment', 'delete'], 'payroll', 'history');
Route::ci('payroll/payment', \App\Http\Controllers\Payroll\Payment::class, ['index', 'add', 'edit', 'salary_month', 'delete', 'get_single_payment'], 'payroll', 'payment');

// Report module
Route::ci('report/report', \App\Http\Controllers\Report\Report::class, ['index', 'income', 'expenditure', 'invoice', 'duefee', 'feecollection', 'balance', 'library', 'sattendance', 'syattendance', 'tattendance', 'tyattendance', 'eattendance', 'eyattendance', 'student', 'sinvoice', 'sactivity', 'payroll', 'statement', 'transaction', 'examresult'], 'report', 'report');
Route::ci('report', \App\Http\Controllers\Report\Report::class, ['index', 'income', 'expenditure', 'invoice', 'duefee', 'feecollection', 'balance', 'library', 'sattendance', 'syattendance', 'tattendance', 'tyattendance', 'eattendance', 'eyattendance', 'student', 'sinvoice', 'sactivity', 'payroll', 'statement', 'transaction', 'examresult'], 'report', 'report');

// Setting module
Route::ci('setting/emailsetting', \App\Http\Controllers\Setting\Emailsetting::class, ['index', 'add', 'edit'], 'setting', 'emailsetting');
Route::ci('setting/module', \App\Http\Controllers\Setting\Module::class, ['index', 'add', 'edit', 'delete'], 'setting', 'module');
Route::ci('setting/openinghour', \App\Http\Controllers\Setting\Openinghour::class, ['index', 'add', 'edit'], 'setting', 'openinghour');
Route::ci('setting/operation', \App\Http\Controllers\Setting\Operation::class, ['index', 'add', 'edit', 'delete'], 'setting', 'operation');
Route::ci('setting/payment', \App\Http\Controllers\Setting\Payment::class, ['index', 'dbbl', 'paypal', 'stripe', 'payumoney', 'ccavenue', 'paytm', 'paystack'], 'setting', 'payment');
Route::ci('setting/setting', \App\Http\Controllers\Setting\Setting::class, ['index', 'add', 'edit', 'logo', 'frontend_logo', 'branch_name', 'branch_url'], 'setting', 'setting');
Route::ci('setting/sms', \App\Http\Controllers\Setting\Sms::class, ['index', 'clickatell', 'twilio', 'bulk', 'msg91', 'plivo', 'textlocal', 'smscountry', 'betasms', 'bulkpk', 'cluster', 'alpha', 'bdbulk', 'mimsms'], 'setting', 'sms');
Route::ci('setting', \App\Http\Controllers\Setting\Setting::class, ['index', 'add', 'edit', 'logo', 'frontend_logo', 'branch_name', 'branch_url'], 'setting', 'setting');

// Student module
Route::ci('student/activity', \App\Http\Controllers\Student\Activity::class, ['index', 'add', 'edit', 'get_single_activity', 'delete'], 'student', 'activity');
Route::ci('student/admission', \App\Http\Controllers\Student\Admission::class, ['index', 'approve', 'get_single_admission', 'waiting', 'decline', 'username', 'photo', 'delete'], 'student', 'admission');
Route::ci('student/bulk', \App\Http\Controllers\Student\Bulk::class, ['index', 'add'], 'student', 'bulk');
Route::ci('student/student', \App\Http\Controllers\Student\Student::class, ['index', 'add', 'edit', 'get_single_student', 'username', 'photo', 'transfer_certificate', 'father_photo', 'mother_photo', 'delete', 'view'], 'student', 'student');
Route::ci('student/type', \App\Http\Controllers\Student\Type::class, ['index', 'add', 'edit', 'type', 'delete'], 'student', 'type');
Route::ci('student', \App\Http\Controllers\Student\Student::class, ['index', 'add', 'edit', 'get_single_student', 'username', 'photo', 'transfer_certificate', 'father_photo', 'mother_photo', 'delete', 'view'], 'student', 'student');

// Teacher module
Route::ci('teacher/lecture', \App\Http\Controllers\Teacher\Lecture::class, ['index', 'add', 'edit', 'get_single_lecture', 'lecture_ppt', 'delete', 'get_teacher_by_subject'], 'teacher', 'lecture');
Route::ci('teacher/teacher', \App\Http\Controllers\Teacher\Teacher::class, ['index', 'add', 'edit', 'get_single_teacher', 'username', 'resume', 'photo', 'delete', 'update_display_order', 'view'], 'teacher', 'teacher');
Route::ci('teacher', \App\Http\Controllers\Teacher\Teacher::class, ['index', 'add', 'edit', 'get_single_teacher', 'username', 'resume', 'photo', 'delete', 'update_display_order', 'view'], 'teacher', 'teacher');

// Transport module
Route::ci('transport/member', \App\Http\Controllers\Transport\Member::class, ['index', 'add', 'delete', 'add_to_transport', 'get_route_by_school', 'get_bus_stop_by_route'], 'transport', 'member');
Route::ci('transport/route', \App\Http\Controllers\Transport\Route::class, ['index', 'add', 'edit', 'get_single_route', 'vehicle_ids', 'title', 'delete', 'remove_stop', 'get_vehicle_by_school'], 'transport', 'route');
Route::ci('transport/transport', \App\Http\Controllers\Transport\Transport::class, ['index'], 'transport', 'transport');
Route::ci('transport/vehicle', \App\Http\Controllers\Transport\Vehicle::class, ['index', 'add', 'edit', 'get_single_vehicle', 'number', 'delete'], 'transport', 'vehicle');
Route::ci('transport', \App\Http\Controllers\Transport\Transport::class, ['index'], 'transport', 'transport');

// Web module
Route::ci('web/web', \App\Http\Controllers\Web\Web::class, ['branch', 'index', 'news', 'news_detail', 'notice', 'notice_detail', 'holiday', 'holiday_detail', 'events', 'event_detail', 'galleries', 'teachers', 'staff', 'page', 'about', 'admission_form', 'admission_online', 'get_guardian_info', 'photo', 'contact'], 'web', 'web');
Route::ci('web', \App\Http\Controllers\Web\Web::class, ['branch', 'index', 'news', 'news_detail', 'notice', 'notice_detail', 'holiday', 'holiday_detail', 'events', 'event_detail', 'galleries', 'teachers', 'staff', 'page', 'about', 'admission_form', 'admission_online', 'get_guardian_info', 'photo', 'contact'], 'web', 'web');
