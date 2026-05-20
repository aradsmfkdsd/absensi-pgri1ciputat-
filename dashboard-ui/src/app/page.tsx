"use client";

import React, { useState } from 'react';
import { 
  Home, 
  GraduationCap, 
  Users, 
  BookOpen, 
  User, 
  LayoutDashboard, 
  Book, 
  CalendarDays, 
  ClipboardCheck, 
  PenTool, 
  FileText, 
  Bus,
  Search,
  Bell,
  MessageSquare,
  ChevronDown,
  Plus,
  Calendar,
  Trash2,
  Edit2,
  MoreHorizontal,
  ChevronLeft,
  ChevronRight
} from 'lucide-react';

// Dummy Data
const studentsData = [
  { id: 1, name: 'Eleanor Pena', roll: '#01', address: 'TA-107 Newyork', class: '01', dob: '02/05/2001', phone: '+123 6988567', avatar: 'https://i.pravatar.cc/150?u=1' },
  { id: 2, name: 'Jessia Rose', roll: '#10', address: 'TA-107 Newyork', class: '02', dob: '03/04/2000', phone: '+123 8988569', avatar: 'https://i.pravatar.cc/150?u=2' },
  { id: 3, name: 'Jenny Wilson', roll: '#04', address: 'Australia, Sydney', class: '01', dob: '12/05/2001', phone: '+123 7988566', avatar: 'https://i.pravatar.cc/150?u=3' },
  { id: 4, name: 'Guy Hawkins', roll: '#03', address: 'Australia, Sydney', class: '02', dob: '03/05/2001', phone: '+123 5988565', avatar: 'https://i.pravatar.cc/150?u=4' },
  { id: 5, name: 'Jacob Jones', roll: '#15', address: 'Australia, Sydney', class: '04', dob: '12/05/2001', phone: '+123 9988568', avatar: 'https://i.pravatar.cc/150?u=5' },
  { id: 6, name: 'Jacob Jones', roll: '#15', address: 'Australia, Sydney', class: '04', dob: '12/05/2001', phone: '+123 9988568', avatar: 'https://i.pravatar.cc/150?u=6' },
  { id: 7, name: 'Jane Cooper', roll: '#01', address: 'Australia, Sydney', class: '04', dob: '12/03/2001', phone: '+123 6988566', avatar: 'https://i.pravatar.cc/150?u=7' },
  { id: 8, name: 'Floyd Miles', roll: '#11', address: 'TA-107 Newyork', class: '01', dob: '03/05/2002', phone: '+123 5988569', avatar: 'https://i.pravatar.cc/150?u=8' },
  { id: 9, name: 'Floyd Miles', roll: '#11', address: 'TA-107 Newyork', class: '01', dob: '03/05/2002', phone: '+123 5988569', avatar: 'https://i.pravatar.cc/150?u=9' },
];

export default function Dashboard() {
  const [selectedRow, setSelectedRow] = useState(2); // Jessia Rose selected by default

  return (
    <div className="flex h-screen bg-[#f4f2f9] font-sans text-slate-800">
      
      {/* SIDEBAR */}
      <aside className="w-64 bg-white border-r border-slate-100 flex flex-col shrink-0 rounded-tr-3xl rounded-br-3xl shadow-sm z-10">
        <div className="h-20 flex items-center px-8 border-b border-transparent">
          <div className="flex items-center gap-2 text-purple-700 font-bold text-xl tracking-tight">
            <div className="w-6 h-6 rounded-md bg-purple-700 text-white flex items-center justify-center text-xs">ia</div>
            ia Academy
          </div>
        </div>
        
        <div className="flex-1 overflow-y-auto py-4 px-4 space-y-1 custom-scrollbar">
          <NavItem icon={<Home size={18} />} label="Home" hasChildren />
          
          {/* Active Students Menu */}
          <div className="mb-1">
            <div className="flex items-center justify-between px-4 py-3 rounded-xl bg-purple-50 text-purple-700 font-medium cursor-pointer">
              <div className="flex items-center gap-3">
                <GraduationCap size={18} />
                <span>Students</span>
              </div>
              <ChevronDown size={16} />
            </div>
            
            <div className="pl-11 mt-1 relative">
              {/* Vertical line indicator */}
              <div className="absolute left-6 top-0 bottom-0 w-0.5 bg-purple-200 rounded-full"></div>
              
              <div className="py-2 px-4 rounded-xl bg-[#f8f5ff] text-purple-700 font-medium text-sm my-1 cursor-pointer relative">
                 <div className="absolute left-[-20px] top-1/2 -translate-y-1/2 w-1 h-6 bg-purple-600 rounded-r-md"></div>
                All Students
              </div>
              <div className="py-2 px-4 text-slate-500 hover:text-slate-700 text-sm my-1 cursor-pointer transition-colors">
                Student Details
              </div>
            </div>
          </div>
          
          <NavItem icon={<Users size={18} />} label="Teachers" hasChildren />
          <NavItem icon={<BookOpen size={18} />} label="Library" />
          <NavItem icon={<User size={18} />} label="Account" hasChildren />
          <NavItem icon={<LayoutDashboard size={18} />} label="Class" />
          <NavItem icon={<Book size={18} />} label="Subject" />
          <NavItem icon={<CalendarDays size={18} />} label="Routine" />
          <NavItem icon={<ClipboardCheck size={18} />} label="Attendance" />
          <NavItem icon={<PenTool size={18} />} label="Exam" hasChildren />
          <NavItem icon={<FileText size={18} />} label="Notice" />
          <NavItem icon={<Bus size={18} />} label="Transport" />
          <NavItem icon={<Home size={18} />} label="Hostel" />
        </div>
      </aside>

      {/* MAIN CONTENT */}
      <main className="flex-1 flex flex-col overflow-hidden relative">
        
        {/* Left Circular Navigation Button (Just visual flair from reference) */}
        <div className="absolute left-[-16px] top-1/3 w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center text-slate-400 z-20 cursor-pointer">
           <ChevronLeft size={16} />
        </div>
        <div className="absolute right-0 top-1/3 w-8 h-8 bg-white rounded-l-full shadow-md flex items-center justify-center text-slate-400 z-20 cursor-pointer">
           <ChevronRight size={16} className="ml-2" />
        </div>

        {/* TOPBAR */}
        <header className="h-20 bg-transparent flex items-center justify-between px-8 shrink-0">
          <div className="relative w-80">
            <input 
              type="text" 
              placeholder="What do you want to find?" 
              className="w-full pl-4 pr-10 py-2.5 rounded-full border border-slate-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-purple-100 focus:border-purple-300 transition-all text-slate-600 placeholder:text-slate-400"
            />
            <Search className="absolute right-4 top-1/2 -translate-y-1/2 text-purple-500" size={16} />
          </div>
          
          <div className="flex items-center gap-6">
            <div className="relative cursor-pointer text-slate-500 hover:text-slate-700">
              <Bell size={20} />
              <div className="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></div>
            </div>
            <div className="cursor-pointer text-slate-500 hover:text-slate-700">
              <MessageSquare size={20} />
            </div>
            
            <div className="flex items-center gap-3 cursor-pointer">
              <img src="https://i.pravatar.cc/150?u=admin" alt="Admin" className="w-9 h-9 rounded-full object-cover" />
              <div className="text-right">
                <div className="text-sm font-semibold text-slate-800">Priscilla Lily</div>
                <div className="text-xs text-slate-500">Admin</div>
              </div>
              <ChevronDown size={16} className="text-slate-500" />
            </div>
          </div>
        </header>

        {/* PAGE CONTENT */}
        <div className="flex-1 overflow-auto px-8 pb-8">
          
          {/* Header Section */}
          <div className="flex items-end justify-between mt-4">
            <div>
              <h1 className="text-2xl font-bold text-slate-800 mb-1">Students List</h1>
              <div className="text-sm text-slate-500">
                Home <span className="mx-1">/</span> <span className="text-purple-600 font-medium">Students</span>
              </div>
            </div>
            
            <button className="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2.5 rounded-xl font-medium text-sm flex items-center gap-2 shadow-sm transition-colors shadow-purple-200">
              <Plus size={18} />
              Add Students
            </button>
          </div>

          {/* Table Card */}
          <div className="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 mt-8">
            
            {/* Card Header */}
            <div className="flex items-center justify-between mb-6">
              <h2 className="text-lg font-bold text-slate-800">Students Information</h2>
              
              <div className="flex items-center gap-4">
                <div className="relative w-64">
                  <input 
                    type="text" 
                    placeholder="Search by name or roll" 
                    className="w-full pl-4 pr-10 py-2 rounded-xl bg-slate-50 border-none text-sm focus:outline-none focus:ring-1 focus:ring-purple-200 text-slate-600 placeholder:text-slate-400"
                  />
                  <Search className="absolute right-3 top-1/2 -translate-y-1/2 text-purple-500" size={16} />
                </div>
                
                <div className="flex items-center gap-2 bg-slate-50 px-4 py-2 rounded-xl cursor-pointer text-slate-600 text-sm hover:bg-slate-100 transition-colors">
                  <Calendar size={16} className="text-slate-400" />
                  <span>Last 30 days</span>
                  <ChevronDown size={14} className="ml-1 text-slate-400" />
                </div>
              </div>
            </div>

            {/* Table */}
            <div className="overflow-x-auto">
              <table className="w-full text-left border-collapse">
                <thead>
                  <tr className="text-xs font-semibold tracking-wider text-slate-500 border-b border-slate-100 uppercase">
                    <th className="pb-4 pl-4 w-12">
                      <div className="w-4 h-4 rounded border border-slate-300"></div>
                    </th>
                    <th className="pb-4 font-semibold">STUDENTS NAME</th>
                    <th className="pb-4 font-semibold">ROLL</th>
                    <th className="pb-4 font-semibold">ADDRESS</th>
                    <th className="pb-4 font-semibold">CLASS</th>
                    <th className="pb-4 font-semibold">DATE OF BIRTH</th>
                    <th className="pb-4 font-semibold">PHONE</th>
                    <th className="pb-4 font-semibold text-center">ACTION</th>
                  </tr>
                </thead>
                <tbody className="text-sm">
                  {studentsData.map((student) => {
                    const isSelected = student.id === selectedRow;
                    return (
                      <tr 
                        key={student.id} 
                        onClick={() => setSelectedRow(student.id)}
                        className={`group border-b border-slate-50 last:border-none cursor-pointer transition-colors ${isSelected ? 'bg-[#fcfaff]' : 'hover:bg-slate-50'}`}
                      >
                        <td className="py-3 pl-4">
                          <div className={`w-4 h-4 rounded border flex items-center justify-center transition-colors ${isSelected ? 'bg-purple-600 border-purple-600' : 'border-slate-300'}`}>
                            {isSelected && <svg className="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={3} d="M5 13l4 4L19 7" /></svg>}
                          </div>
                        </td>
                        <td className="py-3">
                          <div className="flex items-center gap-3">
                            <img src={student.avatar} alt={student.name} className="w-8 h-8 rounded-full object-cover" />
                            <span className="font-medium text-slate-700">{student.name}</span>
                          </div>
                        </td>
                        <td className="py-3 text-slate-500 font-medium">{student.roll}</td>
                        <td className="py-3 text-slate-500">{student.address}</td>
                        <td className="py-3 text-slate-500">{student.class}</td>
                        <td className="py-3 text-slate-500">{student.dob}</td>
                        <td className="py-3 text-slate-500">{student.phone}</td>
                        <td className="py-3">
                          <div className="flex items-center justify-center gap-3 text-slate-400">
                            <Trash2 size={16} className="hover:text-red-500 transition-colors" />
                            <Edit2 size={16} className="hover:text-purple-600 transition-colors" />
                          </div>
                        </td>
                      </tr>
                    );
                  })}
                </tbody>
              </table>
            </div>

            {/* Pagination */}
            <div className="flex items-center justify-center mt-8 gap-2">
              <button className="w-8 h-8 flex items-center justify-center text-slate-400 hover:bg-slate-50 rounded-lg">
                <ChevronLeft size={16} />
              </button>
              
              <button className="w-8 h-8 flex items-center justify-center bg-purple-600 text-white rounded-lg text-sm font-medium">1</button>
              <button className="w-8 h-8 flex items-center justify-center text-slate-600 hover:bg-slate-50 rounded-lg text-sm font-medium">2</button>
              <button className="w-8 h-8 flex items-center justify-center text-slate-600 hover:bg-slate-50 rounded-lg text-sm font-medium">3</button>
              <button className="w-8 h-8 flex items-center justify-center text-slate-600 hover:bg-slate-50 rounded-lg text-sm font-medium">4</button>
              <button className="w-8 h-8 flex items-center justify-center text-slate-600 hover:bg-slate-50 rounded-lg text-sm font-medium">5</button>
              
              <div className="w-8 h-8 flex items-center justify-center text-slate-400">
                <MoreHorizontal size={16} />
              </div>
              
              <button className="w-8 h-8 flex items-center justify-center text-slate-600 hover:bg-slate-50 rounded-lg text-sm font-medium">100</button>
              
              <button className="w-8 h-8 flex items-center justify-center text-slate-400 hover:bg-slate-50 rounded-lg">
                <ChevronRight size={16} />
              </button>

              <div className="ml-4 flex items-center gap-2 bg-slate-50 px-3 py-1.5 rounded-lg cursor-pointer text-slate-600 text-sm hover:bg-slate-100 transition-colors">
                <span>10 / page</span>
                <ChevronDown size={14} className="text-slate-400" />
              </div>
            </div>
            
          </div>
        </div>
      </main>
    </div>
  );
}

// Reusable NavItem Component
function NavItem({ icon, label, hasChildren = false }: { icon: React.ReactNode, label: string, hasChildren?: boolean }) {
  return (
    <div className="flex items-center justify-between px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-700 cursor-pointer transition-colors">
      <div className="flex items-center gap-3">
        {icon}
        <span className="font-medium text-sm">{label}</span>
      </div>
      {hasChildren && <ChevronDown size={16} className="text-slate-400" />}
    </div>
  );
}
