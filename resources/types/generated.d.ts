declare namespace App.Data.Admin.AcademicYearSemester.CreateAcademicYearSemester.Request {
export type CreateAcademicYearSemesterRequestData = {
year: number;
semester: number;
};
}
declare namespace App.Data.Admin.AcademicYearSemester.DeleteAcademicYearSemester.Request {
export type DeleteAcademicYearSemesterRequestData = {
id: number;
};
}
declare namespace App.Data.Admin.AcademicYearSemester.GetcademicYearsSemesters.Response {
export type GetAcademicYearsSemestersResponseData = {
year: number;
semester: number;
};
export type GetAcademicYearsSemestersResponsePaginationResultData = {
data: Array<any>;
current_page: number;
per_page: number;
total: number;
};
}
declare namespace App.Data.Admin.AcademicYearSemester.OpenDepartmentsForRegisteration.Request {
export type OpenDepartmentsForRegisterationRequestData = {
departments_ids: Array<number>;
id: number;
};
}
declare namespace App.Data.Admin.AcademicYearSemester.UpdateAcademicYearSemester.Request {
export type UpdateAcademicYearSemesterRequestData = {
year: number;
semester: number;
id: number;
};
}
declare namespace App.Data.Admin.Admin.CreateAdmin.Request {
export type CreateAdminRequestData = {
name: string;
password: string;
};
}
declare namespace App.Data.Admin.Admin.DeleteAdmin.Request {
export type DeleteAdminRequestData = {
id: number;
};
}
declare namespace App.Data.Admin.Admin.DeleteAdmins.Request {
export type DeleteAdminRequestData = {
ids: { [key: number]: number } | Array<any>;
};
}
declare namespace App.Data.Admin.Admin.GetAdmin.Request {
export type GetAdminRequestData = {
id: number;
};
}
declare namespace App.Data.Admin.Admin.GetAdmin.Response {
export type GetAdminResponseData = {
id: number;
name: string;
};
}
declare namespace App.Data.Admin.Admin.GetAdmins.Response {
export type GetAdminsResponseData = {
id: number;
name: string;
};
export type GetAdminsResponsePaginationResultData = {
data: Array<any>;
current_page: number;
per_page: number;
total: number;
};
}
declare namespace App.Data.Admin.Admin.GetStudents.Response {
export type GetStudentsResponseData = {
department_id: number | null;
national_id: string | null;
birthdate: string | null;
enrollment_date: string | null;
graduation_date: string | null;
phone_number: string | null;
name: string;
};
export type GetStudentsResponsePaginationResultData = {
data: Array<any>;
current_page: number;
per_page: number;
total: number;
};
}
declare namespace App.Data.Admin.Admin.UpdateAdmin.Request {
export type UpdateAdminRequestData = {
name: string;
password: string | null;
id: number;
};
}
declare namespace App.Data.Admin.Admin.UpdateAdmin.Response {
export type UpdateAdminResponseData = {
};
}
declare namespace App.Data.Admin.ClassroomCourseTeacher.AssignClassroomToCourseTeacher.Request {
export type AssignClassroomToCourseTeacherRequestData = {
classroom_id: number;
course_teacher_id: number;
day: number;
from: string;
to: string;
};
}
declare namespace App.Data.Admin.ClassroomCourseTeacher.DeleteClassroomCourseTeacherClassroom.Request {
export type DeleteClassroomCourseTeacherRequestData = {
id: number;
};
}
declare namespace App.Data.Admin.ClassroomCourseTeacher.UpdateCourseTeacherClassroom.Request {
export type UpdateCourseTeacherClassroomRequestData = {
classroom_id: number;
course_teacher_id: number;
day: number;
from: string;
to: string;
id: number;
};
}
declare namespace App.Data.Admin.Course.CreateCourse.Request {
export type CreateCourseRequestData = {
department_id: number;
name: string;
code: string;
is_active: boolean;
credits: number;
open_for_students_in_year: number;
};
}
declare namespace App.Data.Admin.Course.DeleteCourses.Request {
export type DeleteCoursesRequestData = {
ids: Array<any>;
};
}
declare namespace App.Data.Admin.Course.GetCourse.Response {
export type CrossListedItemData = {
id: number;
name: string;
};
export type GetCourseResponseData = {
id: number;
department_id: number;
name: string;
code: string;
is_active: boolean;
credits: number;
open_for_students_in_year: number;
created_at: string;
cross_listed_courses: Array<App.Data.Admin.Course.GetCourse.Response.CrossListedItemData> | Array<any>;
prerequisites: Array<App.Data.Admin.Course.GetCourse.Response.PrerequisiteItemData> | Array<any>;
};
export type PrerequisiteItemData = {
id: number;
name: string;
};
}
declare namespace App.Data.Admin.Course.GetCourseRequest.Request {
export type GetCourseRequestData = {
id: number;
};
}
declare namespace App.Data.Admin.Course.GetCourses.Response {
export type GetCoursesResponseData = {
id: number;
department_id: number;
name: string;
code: string;
is_active: boolean;
credits: number;
open_for_students_in_year: number;
created_at: string;
};
export type GetCoursesResponsePaginationResultData = {
data: Array<any>;
current_page: number;
per_page: number;
total: number;
};
}
declare namespace App.Data.Admin.Course.UpdateCourse.Request.Admin.Course {
export type UpdateCourseRequestData = {
department_id: number;
name: string;
code: string;
is_active: boolean;
credits: number;
open_for_students_in_year: number;
cross_listed_courses_ids: Array<any>;
prerequisites_ids: Array<any>;
id: number;
};
}
declare namespace App.Data.Admin.CourseTeacher.CreateCourseTeacherAttendance.Request {
export type CreateCourseTeacherAttendanceRequestData = {
happened_at: string;
students_attendance: Array<any>;
id: number;
};
export type StudentAttendanceData = {
id: number;
is_present: boolean;
};
}
declare namespace App.Data.Admin.CourseTeacher.DeleteCourseTeacherAttendace.Request {
export type DeleteCourseTeacherAttendanceRequestData = {
id: number;
lecture_id: number;
};
}
declare namespace App.Data.Admin.CourseTeacher.GetCourseTeacherExams.Request {
export type GetCourseTeacherExamsRequestData = {
id: number;
};
}
declare namespace App.Data.Admin.CourseTeacher.GetCourseTeacherExams.Response {
export type GetCourseTeacherExamsResponseData = {
};
}
declare namespace App.Data.Admin.CourseTeacher.GetCourseTeacherLectures.Request {
export type GetCourseTeacherLecturesRequestData = {
id: number;
};
}
declare namespace App.Data.Admin.CourseTeacher.GetCourseTeacherLectures.Response {
export type GetCourseTeacherLecturesResponseData = {
id: number;
happened_at: string;
};
}
declare namespace App.Data.Admin.CourseTeacher.GetCourseTeacherStudents.Response {
export type GetCourseTeacherStudentsRespnseData = {
id: number;
name: string;
};
}
declare namespace App.Data.Admin.CourseTeacher.UpdateCourseTeacherAttendace.Request {
export type StudentAttendanceItemData = {
id: number;
is_student_present: boolean | null;
};
export type UpdateCourseTeacherAttandenceRequestData = {
happened_at: string;
students_attendandces: Array<App.Data.Admin.CourseTeacher.UpdateCourseTeacherAttendace.Request.StudentAttendanceItemData> | Array<any>;
id: number;
lecture_id: number;
};
}
declare namespace App.Data.Admin.Department.CreateDepartment.Request {
export type CreateDepartmentRequestData = {
name: string;
};
}
declare namespace App.Data.Admin.Department.DeleteDepartment.Request {
export type DeleteDepartmentRequestData = {
ids: Array<any>;
};
}
declare namespace App.Data.Admin.Department.GetDepartmentTeachers.Request {
export type GetDepartmentTeachersRequestData = {
id: number;
};
}
declare namespace App.Data.Admin.Department.GetDepartmentTeachers.Response {
export type GetDepartmentTeachersResponseData = {
id: number;
name: string;
};
}
declare namespace App.Data.Admin.Department.GetDepartments.Response {
export type GetDepartmentsResponseData = {
id: number;
name: string;
};
}
declare namespace App.Data.Admin.Department.GetSemesterCourses.Response {
export type GetSemesterCoursesResponseData = {
id: number;
};
}
declare namespace App.Data.Admin.Department.UpdateDepartment.Request {
export type UpdateDepartmentRequestData = {
name: string;
id: number;
};
}
declare namespace App.Data.Admin.Department.UpdateDepartment.Response {
export type UpdateDepartmentResponseData = {
};
}
declare namespace App.Data.Admin.Exam.AssignMarkToStudent.Request {
export type AssignMarkToStudentRequestData = {
exam_students: Array<any>;
id: number;
};
export type ExamStudentItemData = {
student_id: number;
mark: number;
};
}
declare namespace App.Data.Admin.Exam.CreateExam.Request {
export type CreateExamRequestData = {
course_teacher_id: number;
classroom_id: number;
max_mark: number;
date: string;
from: string;
to: string;
is_main_exam: boolean;
};
}
declare namespace App.Data.Admin.Exam.DeleteExam.Request {
export type DeleteExamRequestData = {
id: number;
};
}
declare namespace App.Data.Admin.Exam.GetExam.Request {
export type GetExamRequestData = {
id: number;
};
}
declare namespace App.Data.Admin.Exam.GetExam.Response {
export type ClassroomItemData = {
id: number;
name: string;
};
export type GetExamResponseData = {
course_teacher_id: number;
classroom_id: number;
max_mark: string;
from: string;
to: string;
is_main_exam: boolean;
classroom: App.Data.Admin.Exam.GetExam.Response.ClassroomItemData;
};
}
declare namespace App.Data.Admin.Exam.UpdateExam.Request {
export type UpdateExamRequestData = {
course_teacher_id: number;
classroom_id: number;
max_mark: number;
date: string;
from: string;
to: string;
is_main_exam: boolean;
id: number;
};
}
declare namespace App.Data.Admin.Exam.UpdateStudentExamMark.Request {
export type ExamStudentItemData = {
id: number;
student_id: number;
mark: number;
};
export type UpdateStudentExamMarkRequestData = {
exam_students: Array<any>;
id: number;
};
}
declare namespace App.Data.Admin.Exam.UpdateStudentExamMark.Response {
export type UpdateStudentExamMarkResponseData = {
};
}
declare namespace App.Data.Admin.OpenCourseRegisteration.AssignTeacherToCourse.Request {
export type AssignTeacherToCourseRequestData = {
teacher_id: number;
is_main_teacher: boolean;
id: number;
};
}
declare namespace App.Data.Admin.OpenCourseRegisteration.OpenCourseForRegisteration.Request {
export type CourseData = {
id: number;
price: string;
};
export type OpenCourseForRegisterationRequestData = {
department_id: number | null;
courses: Array<App.Data.Admin.OpenCourseRegisteration.OpenCourseForRegisteration.Request.CourseData> | Array<any>;
};
}
declare namespace App.Data.Admin.OpenCourseRegisteration.UnAssignTeacherFromOpenCourse.Request {
export type UnAssignTeacherFromOpenCourseRequestData = {
teachers_ids: Array<number>;
id: number;
};
}
declare namespace App.Data.Admin.OpenCourseRegisteration.UnRegisterOpenCourse.Request {
export type UnRegisterOpenCourseRequestData = {
id: number;
};
}
declare namespace App.Data.Admin.Student.DeleteStudent.Request {
export type DeleteStudentRequestData = {
id: number;
};
}
declare namespace App.Data.Admin.Student.DeleteStudentProfilePicture.Request {
export type DeleteStudentProfilePictureRequestData = {
id: number;
profile_picture_id: number;
};
}
declare namespace App.Data.Admin.Student.GetStudent.Request {
export type GetStudentRequestData = {
id: number;
};
}
declare namespace App.Data.Admin.Student.GetStudent.Response {
export type GetStudentResponseData = {
department_id: number | null;
national_id: string | null;
birthdate: string | null;
enrollment_date: string | null;
graduation_date: string | null;
phone_number: string | null;
name: string;
profile_picture: App.Data.Shared.Media.MediaData | null;
};
}
declare namespace App.Data.Admin.Student.GraduateStudent.Request {
export type GraduateStudentRequestData = {
graduation_date: string;
};
}
declare namespace App.Data.Admin.Student.RegisterStudent.Request {
export type RegisterStudentRequestData = {
department_id: number | null;
national_id: string;
birthdate: string;
enrollment_date: string;
phone_number: string;
name: string;
password: string;
temporary_profile_picture_id: string | null;
};
}
declare namespace App.Data.Admin.Student.UpdateStudent.Request {
export type UpdateStudentRequestData = {
department_id: number | null;
national_id: string;
birthdate: string;
enrollment_date: string | null;
graduation_date: string | null;
phone_number: string;
name: string;
password: string;
temporary_profile_picture_id: number | null;
school_files_ids_to_add: Array<number> | Array<any>;
school_files_ids_to_delete: Array<number> | Array<any>;
id: number;
};
}
declare namespace App.Data.Admin.Student.UploadStudentProfile.Request {
export type UploadStudentProfilePictureRequestData = {
file: any;
};
}
declare namespace App.Data.Admin.Student.UploadStudentProfile.Response {
export type UploadStudentProfilePictureResponseData = {
file: App.Data.Shared.Media.MediaData;
};
}
declare namespace App.Data.Admin.Student.UploadStudentSchoolFiles.Request {
export type TestFile = {
};
export type UploadStudentSchoolFilesRequestData = {
files: Array<any> | Array<any>;
};
}
declare namespace App.Data.Admin.Teacher.CreateTeacher.Request {
export type CreateTeacherRequestData = {
name: string;
department_id: number;
};
}
declare namespace App.Data.Admin.Teacher.DeleteTeacher.Request {
export type DeleteTeacherRequestData = {
id: number;
};
export type DeleteTeachersRequestData = {
ids: Array<any>;
};
}
declare namespace App.Data.Admin.Teacher.GetTeacher.Request {
export type GetTeacherRequestData = {
id: number;
};
}
declare namespace App.Data.Admin.Teacher.GetTeacher.Response {
export type GetTeacherResponseData = {
id: number;
name: string;
};
}
declare namespace App.Data.Admin.Teacher.GetTeachers.Response {
export type GetTeachersResponseData = {
};
}
declare namespace App.Data.Admin.Teacher.GetTeachersPaginated.Response {
export type GetTeachersPaginatedResponseData = {
id: number;
name: string;
};
export type GetTeachersPaginatedResponsePaginationResultData = {
data: Array<any>;
current_page: number;
per_page: number;
total: number;
};
}
declare namespace App.Data.Admin.Teacher.UpdateTeacher.Request {
export type UpdateTeacherRequestData = {
name: string;
department_id: number;
id: number;
};
}
declare namespace App.Data.Example {
export type ExampleCursorPaginationRequetData = {
data: Array<any>;
per_page: number;
next_cursor: string | null;
};
export type ExampleData = {
id: number;
ids: Array<any>;
};
}
declare namespace App.Data.Shared {
export type ListData = {
id: number;
title: string;
};
}
declare namespace App.Data.Shared.File {
export type CreateFilePathData = {
url: string;
public_id: string;
};
export type DeleteFileData = {
id: string;
};
export type FilePathData = {
url: string;
};
export type ShowFileData = {
uid: number;
url: string;
};
export type UpdateFileData = {
uid: number | null;
url: string;
};
export type UploadFileData = {
file: any;
};
export type UploadFileListData = {
files: Array<any>;
};
export type UploadFileListResponseData = {
files: Array<App.Data.Shared.File.UploadFileResponseData>;
};
export type UploadFileResponseData = {
url: string;
public_id: string;
};
}
declare namespace App.Data.Shared.File.PathParameters {
export type FilePublicIdPathParameterData = {
public_id: string;
};
}
declare namespace App.Data.Shared.Media {
export type MediaData = {
id: string;
file_url: string;
thumbnail_url: string | null;
};
export type SingleMedia = {
id: string;
file_url: string;
};
}
declare namespace App.Data.Student.OpenCourseRegisteration.GetCoursesMarks.Response {
export type CourseItemData = {
id: number;
name: string;
code: string;
credits: number;
};
export type GetCoursesMarksResponseData = {
id: number;
course: App.Data.Student.OpenCourseRegisteration.GetCoursesMarks.Response.CourseItemData;
academic_year_semester_id: number;
final_mark: number;
exam_mark: number;
};
export type GetCoursesMarksResponsePaginationResultData = {
data: Array<any>;
current_page: number;
per_page: number;
total: number;
};
}
declare namespace App.Data.Student.OpenCourseRegisteration.GetCoursesMarksThisSemester.Request {
export type GetCoursesMarksRequestThisSemesterRequestData = {
year: number;
semester: number;
};
}
declare namespace App.Data.Student.OpenCourseRegisteration.GetCoursesMarksThisSemester.Respone {
export type CourseItemData = {
id: number;
name: string;
code: string;
credits: number;
};
export type GetCoursesMarksThisSemesterResponseData = {
id: number;
course: App.Data.Student.OpenCourseRegisteration.GetCoursesMarksThisSemester.Respone.CourseItemData;
academic_year_semester_id: number;
final_mark: number;
exam_mark: number;
};
}
declare namespace App.Data.Student.OpenCourseRegisteration.GetCoursesScheduleThisSemester.Request {
export type GetCoursesScheduleThisSemesterRequestData = {
year: number;
semester: number;
};
}
declare namespace App.Data.Student.OpenCourseRegisteration.GetCoursesScheduleThisSemester.Response {
export type ClassroomItemData = {
id: number;
name: string;
};
export type CourseItemData = {
id: number;
name: string;
};
export type GetCoursesScheduleThisSemesterResponseData = {
id: number;
day: number;
from: string;
to: string;
course: App.Data.Student.OpenCourseRegisteration.GetCoursesScheduleThisSemester.Response.CourseItemData;
teacher: App.Data.Student.OpenCourseRegisteration.GetCoursesScheduleThisSemester.Response.TeacherItemData;
classroom: App.Data.Student.OpenCourseRegisteration.GetCoursesScheduleThisSemester.Response.ClassroomItemData;
};
export type TeacherItemData = {
id: number;
name: string;
};
}
declare namespace App.Data.Student.OpenCourseRegisteration.GetOpenCoursesThisSemester.Response {
export type GetOpenCoursesThisSemesterResponseData = {
year: number;
semester: number;
};
}
declare namespace App.Data.Student.OpenCourseRegisteration.GetStudentRegisteredOpenCoursesThisSemester.Response {
export type CourseItemData = {
id: number;
name: string;
code: string;
credits: number;
};
export type GetStudentRegisteredOpenCoursesThisSemesterResponseData = {
id: number;
academic_year_semester_id: number;
created_at: string;
course: App.Data.Student.OpenCourseRegisteration.GetStudentRegisteredOpenCoursesThisSemester.Response.CourseItemData;
};
export type GetStudentRegisteredOpenCoursesThisSemesterResponsePaginationResultData = {
data: Array<any>;
current_page: number;
per_page: number;
total: number;
};
}
declare namespace App.Data.Student.OpenCourseRegisteration.QueryParameters {
export type GetOpenCoursesThisSemesterQueryParameterData = {
year: number;
semester: number;
};
}
declare namespace App.Data.Student.OpenCourseRegisteration.RegisterCourses.Request {
export type RegisterInOpenCoursesRequestData = {
open_courses_ids: Array<any>;
};
}
declare namespace App.Data.Student.OpenCourseRegisteration.UnRegisterFromOpenCourse.Request {
export type UnRegisterFromOpenCourseRequestData = {
id: number;
};
}
declare namespace App.Data.User.Auth {
export type LoginRequestData = {
};
export type RegisterRequestData = {
phone_number: string;
};
export type RegisterResponseData = {
token: string;
};
}
declare namespace App.Enum {
export type Currency = 'USD' | 'SYP';
export type FileUploadDirectory = 'profile_picture' | 'school_files';
export type Gender = 0 | 1;
}
declare namespace App.Enum.Auth {
export type RolesEnum = 'admin' | 'student' | 'courses registerer' | 'marks assigner';
}
