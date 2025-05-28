import React from "react";
import { Head } from "@inertiajs/react";
import {Sidebar } from "@/components/navigation/sidebar";
import Pembimbing from "@/components/content/pembimbing";
export default function PembimbingPage() {
    return (
      <>
        <Head title="Pembimbing" />
        <div className="flex flex-grow w-full bg-[#02423F]">
          <Sidebar/>
          <Pembimbing/>
        </div>
      </>
    );
}
