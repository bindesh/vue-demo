/**
 * Shared TypeScript types and interfaces for the application
 */

export interface Company {
    id: number;
    name: string;
    description: string | null;
    logo: string | null;
    industry: string | null;
    website: string | null;
    location: string | null;
    founded_year: number | null;
    employee_count: number | null;
    images: string[] | null;
    created_at: string;
    updated_at: string;
}

export interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

export interface Pagination {
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    from: number | null;
    to: number | null;
    links: PaginationLink[];
}

export type TabType = 'about' | 'offer' | 'works' | 'challenges' | 'goals';

