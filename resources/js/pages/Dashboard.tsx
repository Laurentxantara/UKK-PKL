import React from "react";
import { Head } from "@inertiajs/react";
import Dashboard from "@/components/content/dashboard";
import {Sidebar } from "@/components/navigation/sidebar";
export default function HomePage() {
    return (
      <>
        <Head title="Home" />
        <div className="flex flex-grow w-full bg-[#02423F]">
          <Sidebar/>
          <Dashboard/>
        </div>
      </>
    );
}
