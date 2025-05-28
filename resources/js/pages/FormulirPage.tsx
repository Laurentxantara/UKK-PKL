import React from "react";
import { Head } from "@inertiajs/react";
import Formulir from "@/components/content/formulir";
import {Sidebar } from "@/components/navigation/sidebar";
export default function FormulirPage() {
    return (
      <>
        <Head title="Formulir" />
        <div className="flex flex-grow w-full bg-[#02423F]">
          <Sidebar/>
          <Formulir/>
        </div>
      </>
    );
}
