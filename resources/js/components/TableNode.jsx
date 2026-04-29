import React, { useState } from 'react';
import { Handle, Position } from 'reactflow';

export default function TableNode({ data }) {

    const [hovered, setHovered] = useState(null);

    return (
        <div style={{
            border: '1px solid #e5e7eb',
            borderRadius: '12px',
            background: '#ffffff',
            minWidth: '100px',
            boxShadow: '0 8px 24px rgba(0,0,0,0.08)',
            overflow: 'hidden',
            fontSize: '10px',
            padding: '8px 10px',
        }}>

            {/* ================= HEADER ================= */}
            <div style={{

                background: '#fbfbfb',
                minWidth: '100px',
                boxShadow: '0 8px 24px rgba(0,0,0,0.08)',
                overflow: 'hidden',
                padding: '3px 6px',
                fontSize: '6px'
            }}>
                {data.name}
            </div>

            {/* ================= COLUMNS ================= */}
            {data.columns.map((col, i) => (
                <div
                    key={i}
                    onMouseEnter={() => setHovered(i)}
                    onMouseLeave={() => setHovered(null)}
                    style={{
                        padding: '3px',
                        display: 'flex',
                        justifyContent: 'space-between',
                        alignItems: 'center',
                        background: hovered === i ? '#f3f4f6' : '#fff',
                        cursor: 'pointer',
                        position: 'relative'
                    }}
                >

                    {/* ================= LEFT SIDE (FK INPUT) ================= */}
                    {/* сюда ПРИХОДЯТ связи */}
                    <Handle
                        type="target"
                        position={Position.Left}
                        id={`${data.name}-${col.name}-target`}
                        style={{ background: '#ef4444' }} // красный (FK in)
                    />

                    {/* ================= COLUMN NAME ================= */}
                    <span style={{ flex: 1, display: 'flex', gap: '4px' }}>
                        <span>{col.name}</span>

                        {col.name === 'id' && (
                            <span style={{ fontSize: '7px' }}>🔑</span>
                        )}
                    </span>

                    {/* ================= TYPE ================= */}
                    <span style={{ fontSize: '6px', color: '#888' }}>
                        {col.type}
                    </span>

                    {/* ================= RIGHT SIDE (PK OUT) ================= */}
                    {/* отсюда ВЫХОДЯТ связи */}
                    <Handle
                        type="source"
                        position={Position.Right}
                        id={`${data.name}-${col.name}-source`}
                        style={{
                            background: '#94a3b8',
                            width: 8,
                            height: 8,
                            border: '2px solid white'
                        }}
                    />

                </div>
            ))}
        </div>
    );
}
