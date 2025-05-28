import React from "react";
import { Head } from "@inertiajs/react";
import Industri from "@/components/content/industri";
import {Sidebar } from "@/components/navigation/sidebar";
export default function IndustriPage() {
    return (
      <>
        <Head title="Industri" />
        <div className=" bg-[#02423F]">
          <Sidebar/>
          <Industri/>
        </div>
      </>
    );
}
