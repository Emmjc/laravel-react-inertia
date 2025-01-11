import { PROJECT_STATUS_CLASS_MAP, PROJECT_STATUS_TEXT_MAP } from "@/constants.js";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import TasksTable from "../Task/TasksTable";

export default function Show ({project, tasks, success, queryParams}){
    return (
        <AuthenticatedLayout
            header={
                <div className="flex items-center justify-between">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                        {`Projects "${project.name}"`}
                    </h2>
                    {/* Edit button */}
                    <Link
                        href={route("project.edit",project.id)}
                        className="bg-blue-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-blue-600">
                        Edit Project
                    </Link>
                </div>
            }>
            <Head title = {`Projects "${project.name}"`} />
            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div>
                            <img 
                                src={project.image_path}
                                alt =""
                                className="w-full h-64 object-cover"
                            />
                        </div>

                        <div className="p-6 text-gray-900 dark:text-gray-100">


                            <div className="grid gap-1 grid-cols-2 mt-2">
                                {/* Left  Column */}
                                <div>
                                    <div>
                                        <label className="font-bold text-lg">Project ID</label>
                                        <p className="mt-1">{project.id}</p>
                                    </div>

                                    <div className="mt-4">
                                        <label className="font-bold text-lg">Project Name</label>
                                        <p className="mt-1">{project.name}</p>
                                    </div>

                                    <div className="mt-4">
                                        <label className="font-bold text-lg">Project Status</label>
                                        <p className="mt-1">
                                            <span className={
                                                "px-2 py-1 rounded text-white "  + 
                                                PROJECT_STATUS_CLASS_MAP[project.status]
                                                }>
                                                {PROJECT_STATUS_TEXT_MAP[project.status]}
                                            </span>
                                        </p>
                                    </div>

                                    <div className="mt-4">
                                        <label className="font-bold text-lg">Created By</label>
                                        <p className="mt-1">{project.createdBy.name}</p>
                                    </div>
                                </div>

                                {/* Right Column */}
                                <div>
                                    <div>
                                        <label className="font-bold text lg">Due Date</label>
                                        <p className="mt-1">{project.due_date}</p>
                                    </div>
                                    <div className="mt-4">
                                        <label className="font-bold text lg">Created Date</label>
                                        <p className="mt-1">{project.created_at}</p>
                                    </div>

                                    <div className="mt-4">
                                        <label className="font-bold text lg">Updated By</label>
                                        <p className="mt-1">{project.updatedBy.name}</p>
                                    </div>
                                </div>
                            </div>

                            {/* Project Description */}
                            <div className="mt-4">
                                    <label className="font-bold text-lg">Project Description</label>
                                    <p className="mt-1">{project.description}</p>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>

            {/* other project  */}
            <div className="pb-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <TasksTable 
                                tasks={tasks}
                                queryParams={queryParams}
                                hideProjectColumn={true}
                                success={success} />
                        </div>
                    </div>  
                </div>
            </div>  
        </AuthenticatedLayout>
    )
}