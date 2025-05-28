import React from "react";
import { Head } from "@inertiajs/react";
import Siswa from "@/components/content/siswa";
import {Sidebar } from "@/components/navigation/sidebar";
export default function SiswaPage() {
    return (
      <>
        <Head title="Siswa" />
        <div className="flex flex-grow w-full bg-[#02423F]">
          <Sidebar/>
          <Siswa/>
        </div>
      </>
    );
}
